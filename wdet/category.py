import xml.etree.ElementTree as ET


class Category:
    # each category needs a redirect - the old site does not have a category base - example:
    # old: https://wdet.org/topics/culture-music/
    # new: https://wdet.org/category/topics/culture-music/
    def __init__(self, name, slug, description, parent):
        self.name = name
        self.slug = slug
        self.description = description
        self.parent = parent

    @property
    def redirect(self):
        if self.parent:
            return {
                "source": f"/{self.parent}/{self.slug}/",
                "target": f"/category/{self.parent}/{self.slug}/",
            }

        return {
            "source": f"/{self.slug}/",
            "target": f"/category/{self.slug}/",
        }


# get all the topics from the database
def get_topics(connection):
    cursor = connection.cursor()
    cursor.execute("SELECT name, slug, long_description from wdet_topic")

    topics = [Category("Topics", "topics", "", "")]
    for name, slug, description in cursor:
        topics.append(Category(name, slug, description, "topics"))

    cursor.close()
    return topics


# get all the series from the database
def get_series(connection):
    cursor = connection.cursor()
    cursor.execute("SELECT name, slug, long_description from wdet_series")

    series = [Category("Series", "series", "", "")]
    for name, slug, description in cursor:
        series.append(Category(name, slug, description, "series"))

    cursor.close()
    return series


# get all the shows from the database
def get_shows(connection):
    cursor = connection.cursor()
    cursor.execute("SELECT name, slug, long_description from wdet_show")

    shows = [Category("Shows", "shows", "", "")]
    for name, slug, description in cursor:
        shows.append(Category(name, slug, description, "shows"))

    cursor.close()
    return shows


# generates the tag XML, channel is modified in place
# the new term_id is returned
def generate(connection, channel, term_id):
    categories = get_topics(connection)
    categories.extend(get_series(connection))
    categories.extend(get_shows(connection))

    redirects = []

    for category in categories:
        xml_category = ET.SubElement(channel, "wp:category")
        e = ET.SubElement(xml_category, "wp:term_id")
        e.text = str(term_id)
        e = ET.SubElement(xml_category, "wp:category_nicename")
        e.text = category.slug
        e = ET.SubElement(xml_category, "wp:category_parent")
        e.text = category.parent
        e = ET.SubElement(xml_category, "wp:cat_name")
        e.text = category.name
        if category.description:
            e = ET.SubElement(xml_category, "wp:category_description")
            e.text = category.description
        term_id += 1

        redirects.append(category.redirect)

    return term_id, redirects
