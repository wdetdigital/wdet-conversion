import logging
import xml.etree.ElementTree as ET
from datetime import datetime
from email.utils import format_datetime

from pytz import utc

from . import unique

LOG = logging.getLogger(__name__)


def generate_credit_group(channel):
    post_id = unique.post_id()
    created_date = datetime.now()

    item = ET.SubElement(channel, "item")
    e = ET.SubElement(item, "title")
    e.text = "Credit"
    e = ET.SubElement(item, "link")
    e.text = (
        f"https://wdetcms.wdet.org/?post_type=acf-field-group&#038;p={post_id}"
    )
    e = ET.SubElement(item, "pubDate")
    e.text = format_datetime(created_date.astimezone(utc))
    e = ET.SubElement(item, "dc:creator")
    e.text = "admin"
    e = ET.SubElement(item, "guid", attrib={"isPermaLink": "false"})
    e.text = (
        f"https://wdetcms.wdet.org/?post_type=acf-field-group&#038;p={post_id}"
    )
    e = ET.SubElement(item, "description")
    # empty
    e = ET.SubElement(item, "content:encoded")
    e.text = 'a:8:{s:8:"location";a:1:{i:0;a:1:{i:0;a:3:{s:5:"param";s:10:"attachment";s:8:"operator";s:2:"==";s:5:"value";s:3:"all";}}}s:8:"position";s:6:"normal";s:5:"style";s:7:"default";s:15:"label_placement";s:3:"top";s:21:"instruction_placement";s:5:"label";s:14:"hide_on_screen";s:0:"";s:11:"description";s:0:"";s:12:"show_in_rest";i:0;}'
    e = ET.SubElement(item, "excerpt:encoded")
    e.text = "credit"
    e = ET.SubElement(item, "wp:post_id")
    e.text = str(post_id)
    e = ET.SubElement(item, "wp:post_date")
    e.text = str(created_date)[:19]
    e = ET.SubElement(item, "wp:post_date_gmt")
    e.text = str(created_date.astimezone(utc))[:19]
    e = ET.SubElement(item, "wp:post_modified")
    e.text = str(created_date)[:19]
    e = ET.SubElement(item, "wp:post_modified_gmt")
    e.text = str(created_date.astimezone(utc))[:19]
    e = ET.SubElement(item, "wp:comment_status")
    e.text = "closed"
    e = ET.SubElement(item, "wp:ping_status")
    e.text = "closed"
    e = ET.SubElement(item, "wp:post_name")
    e.text = "group_61928c1f9fa91"
    e = ET.SubElement(item, "wp:status")
    e.text = "publish"
    e = ET.SubElement(item, "wp:post_parent")
    e.text = "0"
    e = ET.SubElement(item, "wp:menu_order")
    e.text = "0"
    e = ET.SubElement(item, "wp:post_type")
    e.text = "acf-field-group"
    e = ET.SubElement(item, "wp:post_password")
    # empty
    e = ET.SubElement(item, "wp:is_sticky")
    e.text = "0"

    return post_id


def generate_credit_field(channel, group_id):
    post_id = unique.post_id()
    created_date = datetime.now()

    item = ET.SubElement(channel, "item")
    e = ET.SubElement(item, "title")
    e.text = "Credit"
    e = ET.SubElement(item, "link")
    e.text = f"https://wdetcms.wdet.org/?post_type=acf-field&#038;p={post_id}"
    e = ET.SubElement(item, "pubDate")
    e.text = format_datetime(created_date.astimezone(utc))
    e = ET.SubElement(item, "dc:creator")
    e.text = "admin"
    e = ET.SubElement(item, "guid", attrib={"isPermaLink": "false"})
    e.text = f"https://wdetcms.wdet.org/?post_type=acf-field&#038;p={post_id}"
    e = ET.SubElement(item, "description")
    # empty
    e = ET.SubElement(item, "content:encoded")
    e.text = 'a:10:{s:4:"type";s:4:"text";s:12:"instructions";s:103:"Photo credits are required. It is mandatory that WDET has the rights to publish this image on wdet.org.";s:8:"required";i:1;s:17:"conditional_logic";i:0;s:7:"wrapper";a:3:{s:5:"width";s:0:"";s:5:"class";s:0:"";s:2:"id";s:0:"";}s:13:"default_value";s:0:"";s:11:"placeholder";s:0:"";s:7:"prepend";s:0:"";s:6:"append";s:0:"";s:9:"maxlength";s:0:"";}'
    e = ET.SubElement(item, "excerpt:encoded")
    e.text = "credit"
    e = ET.SubElement(item, "wp:post_id")
    e.text = str(post_id)
    e = ET.SubElement(item, "wp:post_date")
    e.text = str(created_date)[:19]
    e = ET.SubElement(item, "wp:post_date_gmt")
    e.text = str(created_date.astimezone(utc))[:19]
    e = ET.SubElement(item, "wp:post_modified")
    e.text = str(created_date)[:19]
    e = ET.SubElement(item, "wp:post_modified_gmt")
    e.text = str(created_date.astimezone(utc))[:19]
    e = ET.SubElement(item, "wp:comment_status")
    e.text = "closed"
    e = ET.SubElement(item, "wp:ping_status")
    e.text = "closed"
    e = ET.SubElement(item, "wp:post_name")
    e.text = "field_61928d08c7771"
    e = ET.SubElement(item, "wp:status")
    e.text = "publish"
    e = ET.SubElement(item, "wp:post_parent")
    e.text = str(group_id)
    e = ET.SubElement(item, "wp:menu_order")
    e.text = "0"
    e = ET.SubElement(item, "wp:post_type")
    e.text = "acf-field"
    e = ET.SubElement(item, "wp:post_password")
    # empty
    e = ET.SubElement(item, "wp:is_sticky")
    e.text = "0"


def generate_source_field(channel, group_id):
    post_id = unique.post_id()
    created_date = datetime.now()

    item = ET.SubElement(channel, "item")
    e = ET.SubElement(item, "title")
    e.text = "Source / License URL"
    e = ET.SubElement(item, "link")
    e.text = f"https://wdetcms.wdet.org/?post_type=acf-field&#038;p={post_id}"
    e = ET.SubElement(item, "pubDate")
    e.text = format_datetime(created_date.astimezone(utc))
    e = ET.SubElement(item, "dc:creator")
    e.text = "admin"
    e = ET.SubElement(item, "guid", attrib={"isPermaLink": "false"})
    e.text = f"https://wdetcms.wdet.org/?post_type=acf-field&#038;p={post_id}"
    e = ET.SubElement(item, "description")
    # empty
    e = ET.SubElement(item, "content:encoded")
    e.text = 'a:7:{s:4:"type";s:3:"url";s:12:"instructions";s:0:"";s:8:"required";i:0;s:17:"conditional_logic";i:0;s:7:"wrapper";a:3:{s:5:"width";s:0:"";s:5:"class";s:0:"";s:2:"id";s:0:"";}s:13:"default_value";s:0:"";s:11:"placeholder";s:0:"";}'
    e = ET.SubElement(item, "excerpt:encoded")
    e.text = "source_license_url"
    e = ET.SubElement(item, "wp:post_id")
    e.text = str(post_id)
    e = ET.SubElement(item, "wp:post_date")
    e.text = str(created_date)[:19]
    e = ET.SubElement(item, "wp:post_date_gmt")
    e.text = str(created_date.astimezone(utc))[:19]
    e = ET.SubElement(item, "wp:post_modified")
    e.text = str(created_date)[:19]
    e = ET.SubElement(item, "wp:post_modified_gmt")
    e.text = str(created_date.astimezone(utc))[:19]
    e = ET.SubElement(item, "wp:comment_status")
    e.text = "closed"
    e = ET.SubElement(item, "wp:ping_status")
    e.text = "closed"
    e = ET.SubElement(item, "wp:post_name")
    e.text = "field_61928d44c7772"
    e = ET.SubElement(item, "wp:status")
    e.text = "publish"
    e = ET.SubElement(item, "wp:post_parent")
    e.text = str(group_id)
    e = ET.SubElement(item, "wp:menu_order")
    e.text = "0"
    e = ET.SubElement(item, "wp:post_type")
    e.text = "acf-field"
    e = ET.SubElement(item, "wp:post_password")
    # empty
    e = ET.SubElement(item, "wp:is_sticky")
    e.text = "0"


def generate_audio_group(channel):
    post_id = unique.post_id()
    created_date = datetime.now()

    item = ET.SubElement(channel, "item")
    e = ET.SubElement(item, "title")
    e.text = "Audio"
    e = ET.SubElement(item, "link")
    e.text = (
        f"https://wdetcms.wdet.org/?post_type=acf-field-group&#038;p={post_id}"
    )
    e = ET.SubElement(item, "pubDate")
    e.text = format_datetime(created_date.astimezone(utc))
    e = ET.SubElement(item, "dc:creator")
    e.text = "admin"
    e = ET.SubElement(item, "guid", attrib={"isPermaLink": "false"})
    e.text = (
        f"https://wdetcms.wdet.org/?post_type=acf-field-group&#038;p={post_id}"
    )
    e = ET.SubElement(item, "description")
    # empty
    e = ET.SubElement(item, "content:encoded")
    e.text = 'a:8:{s:8:"location";a:1:{i:0;a:1:{i:0;a:3:{s:5:"param";s:9:"post_type";s:8:"operator";s:2:"==";s:5:"value";s:4:"post";}}}s:8:"position";s:6:"normal";s:5:"style";s:7:"default";s:15:"label_placement";s:3:"top";s:21:"instruction_placement";s:5:"label";s:14:"hide_on_screen";s:0:"";s:11:"description";s:0:"";s:12:"show_in_rest";i:0;}'
    e = ET.SubElement(item, "excerpt:encoded")
    e.text = "audio"
    e = ET.SubElement(item, "wp:post_id")
    e.text = str(post_id)
    e = ET.SubElement(item, "wp:post_date")
    e.text = str(created_date)[:19]
    e = ET.SubElement(item, "wp:post_date_gmt")
    e.text = str(created_date.astimezone(utc))[:19]
    e = ET.SubElement(item, "wp:post_modified")
    e.text = str(created_date)[:19]
    e = ET.SubElement(item, "wp:post_modified_gmt")
    e.text = str(created_date.astimezone(utc))[:19]
    e = ET.SubElement(item, "wp:comment_status")
    e.text = "closed"
    e = ET.SubElement(item, "wp:ping_status")
    e.text = "closed"
    e = ET.SubElement(item, "wp:post_name")
    e.text = "group_618cbfe90ec19"
    e = ET.SubElement(item, "wp:status")
    e.text = "publish"
    e = ET.SubElement(item, "wp:post_parent")
    e.text = "0"
    e = ET.SubElement(item, "wp:menu_order")
    e.text = "0"
    e = ET.SubElement(item, "wp:post_type")
    e.text = "acf-field-group"
    e = ET.SubElement(item, "wp:post_password")
    # empty
    e = ET.SubElement(item, "wp:is_sticky")
    e.text = "0"

    return post_id


def generate_audio_field(channel, group_id):
    post_id = unique.post_id()
    created_date = datetime.now()

    item = ET.SubElement(channel, "item")
    e = ET.SubElement(item, "title")
    e.text = "Featured Audio"
    e = ET.SubElement(item, "link")
    e.text = f"https://wdetcms.wdet.org/?post_type=acf-field&#038;p={post_id}"
    e = ET.SubElement(item, "pubDate")
    e.text = format_datetime(created_date.astimezone(utc))
    e = ET.SubElement(item, "dc:creator")
    e.text = "admin"
    e = ET.SubElement(item, "guid", attrib={"isPermaLink": "false"})
    e.text = f"https://wdetcms.wdet.org/?post_type=acf-field&#038;p={post_id}"
    e = ET.SubElement(item, "description")
    # empty
    e = ET.SubElement(item, "content:encoded")
    e.text = 'a:10:{s:4:"type";s:4:"file";s:12:"instructions";s:0:"";s:8:"required";i:0;s:17:"conditional_logic";i:0;s:7:"wrapper";a:3:{s:5:"width";s:0:"";s:5:"class";s:0:"";s:2:"id";s:0:"";}s:13:"return_format";s:3:"url";s:7:"library";s:3:"all";s:8:"min_size";s:0:"";s:8:"max_size";s:0:"";s:10:"mime_types";s:0:"";}'
    e = ET.SubElement(item, "excerpt:encoded")
    e.text = "featured_audio"
    e = ET.SubElement(item, "wp:post_id")
    e.text = str(post_id)
    e = ET.SubElement(item, "wp:post_date")
    e.text = str(created_date)[:19]
    e = ET.SubElement(item, "wp:post_date_gmt")
    e.text = str(created_date.astimezone(utc))[:19]
    e = ET.SubElement(item, "wp:post_modified")
    e.text = str(created_date)[:19]
    e = ET.SubElement(item, "wp:post_modified_gmt")
    e.text = str(created_date.astimezone(utc))[:19]
    e = ET.SubElement(item, "wp:comment_status")
    e.text = "closed"
    e = ET.SubElement(item, "wp:ping_status")
    e.text = "closed"
    e = ET.SubElement(item, "wp:post_name")
    e.text = "field_618cbff5f2653"
    e = ET.SubElement(item, "wp:status")
    e.text = "publish"
    e = ET.SubElement(item, "wp:post_parent")
    e.text = str(group_id)
    e = ET.SubElement(item, "wp:menu_order")
    e.text = "0"
    e = ET.SubElement(item, "wp:post_type")
    e.text = "acf-field"
    e = ET.SubElement(item, "wp:post_password")
    # empty
    e = ET.SubElement(item, "wp:is_sticky")
    e.text = "0"


def generate(channel):
    audio_group_id = generate_audio_group(channel)
    generate_audio_field(channel, audio_group_id)

    credit_group_id = generate_credit_group(channel)
    generate_credit_field(channel, credit_group_id)
    generate_source_field(channel, credit_group_id)

    LOG.info("Added custom field configuration")
