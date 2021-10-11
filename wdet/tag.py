import xml.etree.ElementTree as ET

from . import unique


class Tag:
    # tag URLs match between CMSes, so they can be imported without a redirect
    def __init__(self, name, slug):
        self.name = name
        self.slug = slug


# get all the tags from the database
def get(connection):
    cursor = connection.cursor()
    cursor.execute(
        "SELECT name, slug "
        "FROM taggit_tag "
        "WHERE id IN (SELECT DISTINCT tag_id from taggit_taggeditem)"
    )

    tags = []
    for name, slug in cursor:
        tags.append(Tag(name, slug))

    cursor.close()
    return tags


# generates the tag XML, channel is modified in place
# the new term_id is returned
def generate(connection, channel):
    tags = get(connection)

    for tag in tags:
        xml_tag = ET.SubElement(channel, "wp:tag")
        e = ET.SubElement(xml_tag, "wp:term_id")
        e.text = str(unique.term_id())
        e = ET.SubElement(xml_tag, "wp:tag_slug")
        e.text = tag.slug
        e = ET.SubElement(xml_tag, "wp:tag_name")
        e.text = tag.name

    return []
