import logging

LOG = logging.getLogger(__name__)


def get_redirects(connection):
    cursor = connection.cursor()
    cursor.execute("SELECT old_path, new_path FROM django_redirect")

    redirects = []
    for old_path, new_path in cursor:
        redirects.append(
            {
                "source": old_path,
                "target": new_path,
            }
        )
        LOG.debug("Added redirect from %s to %s", old_path, new_path)

    LOG.info("Retrieved %d redirects", len(redirects))

    return redirects


def generate(connection, channel):
    return get_redirects(connection)
