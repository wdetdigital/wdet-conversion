_term_id = 1000
_post_id = 1000
_user_id = 1  # start with user ID 2 (see below)


def term_id():
    global _term_id
    _term_id += 1
    return _term_id


def post_id():
    global _post_id
    _post_id += 1
    return _post_id


def user_id():
    global _user_id
    _user_id += 1
    return _user_id


__all__ = [term_id, post_id, user_id]
