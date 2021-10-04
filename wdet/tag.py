import xml.etree.ElementTree as ET


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
        "INNER JOIN taggit_taggeditem "
        "  ON taggit_tag.id = taggit_taggeditem.tag_id"
    )

    tags = []
    for name, slug in cursor:
        tags.append(Tag(name, slug))

    cursor.close()
    return tags


# generates the tag XML, channel is modified in place
# the new term_id is returned
def generate(connection, channel, term_id):
    tags = get(connection)

    for tag in tags:
        xml_tag = ET.SubElement(channel, "wp:tag")
        e = ET.SubElement(xml_tag, "wp:term_id")
        e.text = str(term_id)
        e = ET.SubElement(xml_tag, "wp:tag_slug")
        e.text = tag.slug
        e = ET.SubElement(xml_tag, "wp:tag_name")
        e.text = tag.name
        term_id += 1

    return term_id, []
