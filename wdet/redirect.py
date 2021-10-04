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

    return redirects


def generate(connection, channel, term_id):
    redirects = get_redirects(connection)
    return term_id, redirects
