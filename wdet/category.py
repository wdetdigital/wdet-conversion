import logging
import xml.etree.ElementTree as ET

from . import unique

LOG = logging.getLogger(__name__)


class Category:
    # each category needs a redirect - the old site does not have a category base - example:
    # old: https://wdet.org/topics/culture-music/
    # new: https://wdet.org/category/topics/culture-music/
    def __init__(self, name, slug, parent):
        self.name = name
        self.slug = slug
        self.parent = parent

    @property
    def redirect(self):
        if self.parent:
            if self.parent == "topics":
                return {
                    "source": f"/{self.parent}/{self.slug}/",
                    "target": f"/category/{self.parent}/{self.slug}/",
                }
            else:
                return {
                    "target": f"/{self.parent}/{self.slug}/",
                    "source": f"/category/{self.parent}/{self.slug}/",
                }

        if self.slug == "topics":
            return {
                "source": f"/{self.slug}/",
                "target": f"/category/{self.slug}/",
            }
        else:
            return {
                "target": f"/{self.slug}/",
                "source": f"/category/{self.slug}/",
            }


# get all the topics from the database
def get_topics(connection):
    cursor = connection.cursor()
    cursor.execute("SELECT name, slug FROM wdet_topic")

    topics = [Category("Topics", "topics", "")]
    for name, slug in cursor:
        topics.append(Category(name, slug, "topics"))

    LOG.info("Retrieved %d topics", len(topics))

    cursor.close()
    return topics


# get all the series from the database
def get_series(connection):
    cursor = connection.cursor()
    cursor.execute("SELECT name, slug FROM wdet_series")

    series = [Category("Series", "series", "")]
    for name, slug in cursor:
        series.append(Category(name, slug, "series"))

    LOG.info("Retrieved %d series", len(series))

    cursor.close()
    return series


# get all the shows from the database
def get_shows(connection):
    cursor = connection.cursor()
    cursor.execute("SELECT name, slug FROM wdet_show")

    shows = [Category("Shows", "shows", "")]
    for name, slug in cursor:
        shows.append(Category(name, slug, "shows"))

    LOG.info("Retrieved %d shows", len(shows))

    cursor.close()
    return shows


# generates the tag XML, channel is modified in place
# the new term_id is returned
def generate(connection, channel):
    categories = get_topics(connection)
    categories.extend(get_series(connection))
    categories.extend(get_shows(connection))

    redirects = []

    for category in categories:
        xml_category = ET.SubElement(channel, "wp:category")
        e = ET.SubElement(xml_category, "wp:term_id")
        e.text = str(unique.term_id())
        e = ET.SubElement(xml_category, "wp:category_nicename")
        e.text = category.slug
        e = ET.SubElement(xml_category, "wp:category_parent")
        e.text = category.parent
        e = ET.SubElement(xml_category, "wp:cat_name")
        e.text = category.name

        redirects.append(category.redirect)

        LOG.debug("Added category: %s/%s", category.parent, category.name)

    return redirects
