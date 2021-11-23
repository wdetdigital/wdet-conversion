import logging
import xml.etree.ElementTree as ET
from datetime import datetime

from pytz import timezone, utc
from slugify import slugify

from . import unique
from .user import username_exists

LOG = logging.getLogger(__name__)


class Asset:
    eastern = timezone("US/Eastern")

    def __init__(
        self,
        created,
        username,
        last_modified,
        name,
        content,
        credit,
        source,
        notes,
    ):
        self.created_utc = utc.localize(created)
        self.username = username
        self.last_modified_utc = utc.localize(last_modified)
        self.name = name
        self.content = content
        self.credit = credit
        self.source = source
        self.notes = notes
        self.post_id = unique.post_id()

    @property
    def guid(self):
        return f"https://wdetcms.wdet.org/media/{self.content}"

    @property
    def slug(self):
        return slugify(self.content)

    @property
    def post_date(self):
        return str(self.created_utc.astimezone(self.eastern))[:19]

    @property
    def post_date_gmt(self):
        return str(self.created_utc)[:19]

    @property
    def post_modified(self):
        return str(self.last_modified_utc.astimezone(self.eastern))[:19]

    @property
    def post_modified_gmt(self):
        return str(self.last_modified_utc)[:19]


# ID to asset cache
asset_cache = {}


def get_asset(connection, asset_id):
    cursor = connection.cursor()
    cursor.execute(
        "SELECT created, username, last_modified, name, content, credit, source, notes "
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
        source,
        notes,
    ) in cursor:
        asset = Asset(
            created,
            username,
            last_modified,
            name,
            content,
            credit,
            source,
            notes,
        )

    asset_cache[asset_id] = asset
    return asset


def generate_one_from_path(channel, path, post_parent=0):
    asset_id = unique.post_id()
    created_date = datetime.now()

    item = ET.SubElement(channel, "item")
    e = ET.SubElement(item, "title")
    e.text = path
    e = ET.SubElement(item, "guid", attrib={"isPermaLink": "false"})
    e.text = f"https://wdetcms.wdet.org/media/{path}"
    e = ET.SubElement(item, "dc:creator")
    e.text = "admin"
    e = ET.SubElement(item, "content:encoded")
    # empty
    e = ET.SubElement(item, "excerpt:encoded")
    # empty
    e = ET.SubElement(item, "wp:post_id")
    e.text = str(asset_id)
    e = ET.SubElement(item, "wp:post_date")
    e.text = str(created_date)[:19]
    e = ET.SubElement(item, "wp:post_date_gmt")
    e.text = str(created_date.astimezone(utc))[:19]
    e = ET.SubElement(item, "wp:comment_status")
    e.text = "closed"
    e = ET.SubElement(item, "wp:ping_status")
    e.text = "closed"
    e = ET.SubElement(item, "wp:post_name")
    e.text = slugify(path)
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

    LOG.debug("Added asset: %s", path)

    return asset_id


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
    e.text = asset.username if username_exists(asset.username) else "admin"
    e = ET.SubElement(item, "content:encoded")
    e.text = asset.notes
    e = ET.SubElement(item, "excerpt:encoded")
    # empty
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
    if asset.credit:
        meta = ET.SubElement(item, "wp:postmeta")
        e = ET.SubElement(meta, "wp:meta_key")
        e.text = "credit"
        e = ET.SubElement(meta, "wp:meta_value")
        e.text = asset.credit
        meta = ET.SubElement(item, "wp:postmeta")
        e = ET.SubElement(meta, "wp:meta_key")
        e.text = "_credit"
        e = ET.SubElement(meta, "wp:meta_value")
        e.text = "field_61928d08c7771"
    if asset.source:
        meta = ET.SubElement(item, "wp:postmeta")
        e = ET.SubElement(meta, "wp:meta_key")
        e.text = "source_license_url"
        e = ET.SubElement(meta, "wp:meta_value")
        e.text = asset.source
        meta = ET.SubElement(item, "wp:postmeta")
        e = ET.SubElement(meta, "wp:meta_key")
        e.text = "_source_license_url"
        e = ET.SubElement(meta, "wp:meta_value")
        e.text = "field_61928d44c7772"

    LOG.debug("Added asset: %d", asset_id)

    return asset.post_id
