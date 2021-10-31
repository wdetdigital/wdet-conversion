import logging
import xml.etree.ElementTree as ET

from pytz import timezone, utc
from slugify import slugify

from . import asset, unique
from .author import get_author_by_id
from .category import Category
from .tag import Tag
from .user import username_exists

LOG = logging.getLogger(__name__)


class Post:
    eastern = timezone("US/Eastern")

    def __init__(
        self,
        post_id,
        username,
        last_modified,
        title,
        publish_datetime,
        description,
        content,
        asset_id,
        tags,
        topics,
        series,
        shows,
        authors,
    ):
        self.old_post_id = post_id
        self.username = username
        self.last_modified_utc = last_modified
        self.title = title
        self.publish_datetime_utc = publish_datetime
        self.description = description
        self.content = content
        self.asset_id = asset_id
        self.tags = tags
        self.topics = topics
        self.series = series
        self.shows = shows
        self.authors = authors
        self.post_id = unique.post_id()

    @property
    def post_date(self):
        return str(self.eastern.localize(self.publish_datetime_utc))[:19]

    @property
    def post_date_gmt(self):
        return str(self.publish_datetime_utc.astimezone(utc))[:19]

    @property
    def post_modified(self):
        return str(self.eastern.localize(self.last_modified_utc))[:19]

    @property
    def post_modified_gmt(self):
        return str(self.last_modified_utc.astimezone(utc))[:19]

    @property
    def slug(self):
        return slugify(self.title)

    @property
    def redirect(self):
        date = self.eastern.localize(self.publish_datetime_utc).strftime(
            "%Y/%m/%d"
        )
        return {
            "source": f"/posts/{date}/{self.old_post_id}-{self.slug}/",
            "target": f"/{date}/{self.slug}",
        }


def get_tags(connection, post_id):
    cursor = connection.cursor()
    cursor.execute(
        "SELECT name, slug "
        "FROM taggit_tag "
        "INNER JOIN taggit_taggeditem "
        "  ON taggit_tag.id = taggit_taggeditem.tag_id "
        "WHERE object_id = %s AND content_type_id = 17",
        (post_id,),
    )

    tags = []
    for name, slug in cursor:
        tags.append(Tag(name, slug))

    LOG.debug("Retrieved %d post tags for post %d", len(tags), post_id)

    cursor.close()
    return tags


def get_topics(connection, post_id):
    cursor = connection.cursor()
    cursor.execute(
        "SELECT name, slug "
        "FROM wdet_topic "
        "INNER JOIN wdet_post_topics "
        "  ON wdet_topic.id = wdet_post_topics.topic_id "
        "WHERE post_id = %s",
        (post_id,),
    )

    topics = []
    for name, slug in cursor:
        topics.append(Category(name, slug, "", ""))

    LOG.debug("Retrieved %d post topics for post %d", len(topics), post_id)

    cursor.close()
    return topics


def get_series(connection, post_id):
    cursor = connection.cursor()
    cursor.execute(
        "SELECT name, slug "
        "FROM wdet_series "
        "INNER JOIN wdet_post_series_set "
        "  ON wdet_series.id = wdet_post_series_set.series_id "
        "WHERE post_id = %s",
        (post_id,),
    )

    series = []
    for name, slug in cursor:
        series.append(Category(name, slug, "", ""))

    LOG.debug("Retrieved %d post series for post %d", len(series), post_id)

    cursor.close()
    return series


def get_shows(connection, post_id):
    cursor = connection.cursor()
    cursor.execute(
        "SELECT name, slug "
        "FROM wdet_show "
        "INNER JOIN wdet_post_shows "
        "  ON wdet_show.id = wdet_post_shows.show_id "
        "WHERE post_id = %s",
        (post_id,),
    )

    shows = []
    for name, slug in cursor:
        shows.append(Category(name, slug, "", ""))

    LOG.debug("Retrieved %d post shows for post %d", len(shows), post_id)

    cursor.close()
    return shows


def get_authors(connection, post_id):
    cursor = connection.cursor()
    cursor.execute(
        "SELECT person_id FROM wdet_post_authors WHERE post_id = %s",
        (post_id,),
    )

    authors = []
    for (author_id,) in cursor:
        authors.append(get_author_by_id(author_id))

    LOG.debug("Retrieved %d post authors for post %d", len(authors), post_id)

    cursor.close()
    return authors


def get_posts(connection):
    cursor = connection.cursor()
    cursor.execute(
        "SELECT wdet_post.id, username, last_modified, title, publish_datetime, "
        "  description, content, thumbnail_image_id "
        "FROM wdet_post "
        "INNER JOIN auth_user "
        "  ON wdet_post.created_user_id = auth_user.id "
        "WHERE status = 'published' and wdet_post.content != ''"
    )

    posts = []

    rows = []
    for (
        post_id,
        username,
        last_modified,
        title,
        publish_datetime,
        description,
        content,
        asset_id,
    ) in cursor:
        rows.append(
            (
                post_id,
                username,
                last_modified,
                title,
                publish_datetime,
                description,
                content,
                asset_id,
            )
        )
    cursor.close()

    for (
        post_id,
        username,
        last_modified,
        title,
        publish_datetime,
        description,
        content,
        asset_id,
    ) in rows:
        tags = get_tags(connection, post_id)
        topics = get_topics(connection, post_id)
        series = get_series(connection, post_id)
        shows = get_shows(connection, post_id)
        authors = get_authors(connection, post_id)
        posts.append(
            Post(
                post_id,
                username,
                last_modified,
                title,
                publish_datetime,
                description,
                content,
                asset_id,
                tags,
                topics,
                series,
                shows,
                authors,
            )
        )

    LOG.info("Retrieved %d posts", len(posts))

    return posts


def generate(connection, wxr_header):
    posts = get_posts(connection)

    root, channel = wxr_header()
    redirects = []
    for index, post in enumerate(posts):
        item = ET.SubElement(channel, "item")
        e = ET.SubElement(item, "title")
        e.text = post.title
        e = ET.SubElement(item, "guid", attrib={"isPermaLink": "false"})
        e.text = f"https://wdet.org/?p={post.post_id}"
        e = ET.SubElement(item, "dc:creator")
        e.text = post.username if username_exists(post.username) else "admin"
        e = ET.SubElement(item, "content:encoded")
        e.text = post.content
        e = ET.SubElement(item, "excerpt:encoded")
        e.text = post.description
        e = ET.SubElement(item, "wp:post_id")
        e.text = str(post.post_id)
        e = ET.SubElement(item, "wp:post_date")
        e.text = post.post_date
        e = ET.SubElement(item, "wp:post_date_gmt")
        e.text = post.post_date_gmt
        e = ET.SubElement(item, "wp:post_modified")
        e.text = post.post_modified
        e = ET.SubElement(item, "wp:post_modified_gmt")
        e.text = post.post_modified_gmt
        e = ET.SubElement(item, "wp:comment_status")
        e.text = "closed"
        e = ET.SubElement(item, "wp:ping_status")
        e.text = "closed"
        e = ET.SubElement(item, "wp:post_name")
        e.text = post.slug
        e = ET.SubElement(item, "wp:status")
        e.text = "publish"
        e = ET.SubElement(item, "wp:post_parent")
        e.text = "0"
        e = ET.SubElement(item, "wp:menu_order")
        e.text = "0"
        e = ET.SubElement(item, "wp:post_type")
        e.text = "post"
        e = ET.SubElement(item, "wp:post_password")
        # empty
        e = ET.SubElement(item, "wp:is_sticky")
        e.text = "0"

        for tag in post.tags:
            e = ET.SubElement(
                item,
                "category",
                attrib={"domain": "post_tag", "nicename": tag.slug},
            )
            e.text = tag.name

        for show in post.shows:
            e = ET.SubElement(
                item,
                "category",
                attrib={"domain": "category", "nicename": show.slug},
            )
            e.text = show.name

        for series in post.series:
            e = ET.SubElement(
                item,
                "category",
                attrib={"domain": "category", "nicename": series.slug},
            )
            e.text = series.name

        for topic in post.topics:
            e = ET.SubElement(
                item,
                "category",
                attrib={"domain": "category", "nicename": topic.slug},
            )
            e.text = topic.name

        for author in post.authors:
            e = ET.SubElement(
                item,
                "category",
                attrib={"domain": "author", "nicename": author.slug},
            )
            e.text = author.name

        meta = ET.SubElement(item, "wp:postmeta")
        e = ET.SubElement(meta, "wp:meta_key")
        e.text = "ppma_authors_name"
        e = ET.SubElement(meta, "wp:meta_value")
        e.text = ", ".join([author.name for author in post.authors])

        if post.asset_id:
            asset_id = asset.generate_one(
                connection, channel, post.asset_id, post.post_id
            )

            meta = ET.SubElement(item, "wp:postmeta")
            e = ET.SubElement(meta, "wp:meta_key")
            e.text = "_thumbnail_id"
            e = ET.SubElement(meta, "wp:meta_value")
            e.text = str(asset_id)

        redirects.append(post.redirect)

        LOG.debug("Added post: %s", post.title)

        if (index + 1) % 1000 == 0:
            LOG.info("Finished processing post %d", index)
            yield root, redirects
            root, channel = wxr_header()
            redirects = []

    yield root, redirects
