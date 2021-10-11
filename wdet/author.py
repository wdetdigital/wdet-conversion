import xml.etree.ElementTree as ET

from slugify import slugify

from . import asset, unique


class Author:
    def __init__(
        self,
        person_id,
        user_id,
        username,
        first_name,
        last_name,
        email,
        bio,
        photo_id,
    ):
        self.person_id = person_id
        self.user_id = 0
        if user_id:
            self.user_id = user_id
        self.username = username
        self.first_name = first_name
        self.last_name = last_name
        self.email = email
        self.bio = bio
        self.photo_id = photo_id

    @property
    def slug(self):
        if self.username:
            return self.username

        return slugify(self.name)

    @property
    def name(self):
        return f"{self.first_name} {self.last_name}"

    @property
    def redirect(self):
        return {
            "source": f"/author/{self.person_id}/",
            "target": f"/author/{self.slug}/",
        }


# a map of people IDs to author objects
person_author = {}


def get_author_by_id(person_id):
    return person_author[person_id]


def get_authors(connection):
    cursor = connection.cursor()
    cursor.execute(
        "SELECT wdet_person.id, auth_user.id, username, given_name, "
        "  surname, wdet_person.email, long_bio, photo_id "
        "FROM wdet_person "
        "LEFT OUTER JOIN auth_user "
        "  ON wdet_person.user_id = auth_user.id"
    )

    authors = []
    # person_id, user_id, username, first_name, last_name, email, bio
    for (
        person_id,
        user_id,
        username,
        first_name,
        last_name,
        email,
        bio,
        photo_id,
    ) in cursor:
        author = Author(
            person_id,
            user_id,
            username,
            first_name,
            last_name,
            email,
            bio,
            photo_id,
        )
        authors.append(author)
        person_author[person_id] = author

    cursor.close()
    return authors


def generate(connection, channel):
    authors = get_authors(connection)

    redirects = []

    for author in authors:
        xml_author = ET.SubElement(channel, "wp:term")
        e = ET.SubElement(xml_author, "wp:term_id")
        e.text = str(unique.term_id())
        e = ET.SubElement(xml_author, "wp:term_taxonomy")
        e.text = "author"
        e = ET.SubElement(xml_author, "wp:term_slug")
        e.text = author.slug
        ET.SubElement(xml_author, "wp:term_parent")
        e = ET.SubElement(xml_author, "wp:term_name")
        e.text = author.name
        if author.user_id:
            meta = ET.SubElement(xml_author, "wp:termmeta")
            e = ET.SubElement(meta, "wp:meta_key")
            e.text = f"user_id_{author.user_id}"
            e = ET.SubElement(meta, "wp:meta_value")
            e.text = "user_id"
        meta = ET.SubElement(xml_author, "wp:termmeta")
        e = ET.SubElement(meta, "wp:meta_key")
        e.text = "user_id"
        e = ET.SubElement(meta, "wp:meta_value")
        e.text = str(author.user_id)
        meta = ET.SubElement(xml_author, "wp:termmeta")
        e = ET.SubElement(meta, "wp:meta_key")
        e.text = "first_name"
        e = ET.SubElement(meta, "wp:meta_value")
        e.text = author.first_name
        meta = ET.SubElement(xml_author, "wp:termmeta")
        e = ET.SubElement(meta, "wp:meta_key")
        e.text = "last_name"
        e = ET.SubElement(meta, "wp:meta_value")
        e.text = author.last_name
        meta = ET.SubElement(xml_author, "wp:termmeta")
        e = ET.SubElement(meta, "wp:meta_key")
        e.text = "user_email"
        e = ET.SubElement(meta, "wp:meta_value")
        e.text = author.email
        meta = ET.SubElement(xml_author, "wp:termmeta")
        e = ET.SubElement(meta, "wp:meta_key")
        e.text = "user_login"
        e = ET.SubElement(meta, "wp:meta_value")
        e.text = author.username
        meta = ET.SubElement(xml_author, "wp:termmeta")
        e = ET.SubElement(meta, "wp:meta_key")
        e.text = "user_url"
        ET.SubElement(meta, "wp:meta_value")
        meta = ET.SubElement(xml_author, "wp:termmeta")
        e = ET.SubElement(meta, "wp:meta_key")
        e.text = "description"
        e = ET.SubElement(meta, "wp:meta_value")
        e.text = author.bio
        if author.photo_id:
            meta = ET.SubElement(xml_author, "wp:termmeta")
            e = ET.SubElement(meta, "wp:meta_key")
            e.text = "avatar"
            e = ET.SubElement(meta, "wp:meta_value")
            e.text = str(
                asset.generate_one(connection, channel, author.photo_id)
            )

        redirects.append(author.redirect)

    return redirects
