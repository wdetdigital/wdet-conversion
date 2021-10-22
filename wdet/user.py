import logging
import xml.etree.ElementTree as ET

from . import unique

LOG = logging.getLogger(__name__)


class User:
    def __init__(self, username, email, first_name, last_name):
        self.user_id = unique.user_id()
        self.username = username.strip()
        self.email = email.strip()
        self.first_name = first_name.strip()
        self.last_name = last_name.strip()


# map of old CMS user IDs to user objects
user_id_map = {}
# a set of usernames
usernames = set()


def get_user_by_id(user_id):
    return user_id_map.get(user_id)


def username_exists(username):
    return username in usernames


def get_users(connection):
    cursor = connection.cursor()
    # ignore the admin ID and the JamesK ID
    cursor.execute(
        "SELECT id, username, first_name, last_name, email "
        "FROM auth_user WHERE id NOT IN (12, 122) AND is_active = 1"
    )

    users = []
    for user_id, username, first_name, last_name, email in cursor:
        user = User(username, email, first_name, last_name)
        users.append(user)
        user_id_map[user_id] = user
        usernames.add(username)

    LOG.info("Retrieved %d users", len(users))

    cursor.close()
    return users


def generate(connection, channel):
    users = get_users(connection)

    for user in users:
        xml_user = ET.SubElement(channel, "wp:author")
        # reuse the django ID - makes things easier for importing authors
        e = ET.SubElement(xml_user, "wp:author_id")
        e.text = str(user.user_id)
        e = ET.SubElement(xml_user, "wp:author_login")
        e.text = user.username
        e = ET.SubElement(xml_user, "wp:author_email")
        e.text = user.email
        e = ET.SubElement(xml_user, "wp:author_display_name")
        e.text = f"{user.first_name} {user.last_name}".strip()
        e = ET.SubElement(xml_user, "wp:author_first_name")
        e.text = user.first_name
        e = ET.SubElement(xml_user, "wp:author_last_name")
        e.text = user.last_name

        LOG.debug("Added user: %s", user.username)

    return []
