import logging
import xml.etree.ElementTree as ET

import mysql.connector

from . import author, category, custom_field, post, redirect, tag, user

LOG = logging.getLogger(__name__)


def wxr_header(site_url):
    root = ET.Element(
        "rss",
        attrib={
            "version": "2.0",
            "xmlns:excerpt": "http://wordpress.org/export/1.2/excerpt/",
            "xmlns:content": "http://purl.org/rss/1.0/modules/content/",
            "xmlns:wfw": "http://wellformedweb.org/CommentAPI/",
            "xmlns:dc": "http://purl.org/dc/elements/1.1/",
            "xmlns:wp": "http://wordpress.org/export/1.2/",
        },
    )
    channel = ET.SubElement(root, "channel")

    e = ET.SubElement(channel, "wp:wxr_version")
    e.text = "1.2"
    e = ET.SubElement(channel, "wp:base_site_url")
    e.text = site_url

    return root, channel


# reads in data from the django CMS database and returns an XML file to be exported
def wxr(host, database, db_user, password, site_url):
    LOG.info("Generating wxr files")

    connection = mysql.connector.connect(
        host=host, database=database, user=db_user, password=password
    )

    roots = []
    root, channel = wxr_header(site_url)
    roots.append(root)

    # start with no redirects
    redirects = []

    redirects.extend(tag.generate(connection, channel))
    redirects.extend(
        category.generate(connection, channel)
    )  # topics, shows, and series
    redirects.extend(redirect.generate(connection, channel))
    redirects.extend(user.generate(connection, channel))
    redirects.extend(author.generate(connection, channel))
    custom_field.generate(channel)

    for root, redirs in post.generate(
        connection, lambda: wxr_header(site_url)
    ):
        roots.append(root)
        redirects.extend(redirs)

    LOG.info("Done generating wxr")

    return roots, redirects
