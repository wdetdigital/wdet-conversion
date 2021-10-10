import xml.etree.ElementTree as ET

import mysql.connector

from . import category, redirect, tag, user


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
    connection = mysql.connector.connect(
        host=host, database=database, user=db_user, password=password
    )
    root, channel = wxr_header(site_url)

    # skip over any existing term IDs
    term_id = 1000
    # start with no redirects
    redirects = []

    # generate tags
    term_id, r = tag.generate(connection, channel, term_id)
    redirects.extend(r)
    # generate categories (topics, shows, and series)
    term_id, r = category.generate(connection, channel, term_id)
    redirects.extend(r)
    # generate redirects
    term_id, r = redirect.generate(connection, channel, term_id)
    redirects.extend(r)

    user.generate(connection, channel)

    return root, redirects
