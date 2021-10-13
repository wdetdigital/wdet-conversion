import logging
import xml.etree.ElementTree as ET

from pytz import timezone, utc
from slugify import slugify

from . import unique

LOG = logging.getLogger(__name__)


class Asset:
    eastern = timezone("US/Eastern")

    def __init__(
        self, created, username, last_modified, name, content, credit, notes
    ):
        self.created_utc = created
        self.username = username
        self.last_modified_utc = last_modified
        self.name = name
        self.content = content
        self.credit = credit
        self.notes = notes
        self.post_id = unique.post_id()

    @property
    def guid(self):
        return f"https://wdet.org/media/{self.content}"

    @property
    def slug(self):
        return slugify(self.content)

    @property
    def post_date(self):
        return str(self.eastern.localize(self.created_utc))[:19]

    @property
    def post_date_gmt(self):
        return str(self.created_utc.astimezone(utc))[:19]

    @property
    def post_modified(self):
        return str(self.eastern.localize(self.last_modified_utc))[:19]

    @property
    def post_modified_gmt(self):
        return str(self.last_modified_utc.astimezone(utc))[:19]


# ID to asset cache
asset_cache = {}


def get_asset(connection, asset_id):
    cursor = connection.cursor()
    cursor.execute(
        "SELECT created, username, last_modified, name, content, credit, notes "
        "FROM wdet_asset "
        "INNER JOIN auth_user ON wdet_asset.created_user_id = auth_user.id "
        "WHERE wdet_asset.id = %s",
        (asset_id,),
    )

    for (
        created,
        username,
        last_modified,
        name,
        content,
        credit,
        notes,
    ) in cursor:
        asset = Asset(
            created, username, last_modified, name, content, credit, notes
        )

    asset_cache[asset_id] = asset
    return asset


def generate_one(connection, channel, asset_id, post_parent=0):
    # did we already generate this? then don't do it again
    # note: this could present problems for reused feature images (wrong parent)
    if asset_id in asset_cache:
        LOG.debug("Retrieving asset from cache: %d", asset_id)
        return asset_cache[asset_id].post_id

    asset = get_asset(connection, asset_id)

    item = ET.SubElement(channel, "item")
    e = ET.SubElement(item, "title")
    e.text = asset.name
    e = ET.SubElement(item, "guid", attrib={"isPermaLink": "false"})
    e.text = asset.guid
    e = ET.SubElement(item, "dc:creator")
    e.text = asset.username
    e = ET.SubElement(item, "content:encoded")
    e.text = asset.notes
    e = ET.SubElement(item, "excerpt:encoded")
    e.text = asset.credit
    e = ET.SubElement(item, "wp:post_id")
    e.text = str(asset.post_id)
    e = ET.SubElement(item, "wp:post_date")
    e.text = asset.post_date
    e = ET.SubElement(item, "wp:post_date_gmt")
    e.text = asset.post_date_gmt
    e = ET.SubElement(item, "wp:post_modified")
    e.text = asset.post_modified
    e = ET.SubElement(item, "wp:post_modified_gmt")
    e.text = asset.post_modified_gmt
    e = ET.SubElement(item, "wp:comment_status")
    e.text = "closed"
    e = ET.SubElement(item, "wp:ping_status")
    e.text = "closed"
    e = ET.SubElement(item, "wp:post_name")
    e.text = asset.slug
    e = ET.SubElement(item, "wp:status")
    e.text = "inherit"
    e = ET.SubElement(item, "wp:post_parent")
    e.text = str(post_parent)
    e = ET.SubElement(item, "wp:menu_order")
    e.text = "0"
    e = ET.SubElement(item, "wp:post_type")
    e.text = "attachment"
    ET.SubElement(item, "wp:post_password")
    e = ET.SubElement(item, "wp:is_sticky")
    e.text = "0"

    LOG.debug("Added asset: %d", asset_id)

    return asset.post_id
