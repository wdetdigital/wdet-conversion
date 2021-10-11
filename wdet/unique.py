_term_id = 1000
_post_id = 1000


def term_id():
    global _term_id
    _term_id += 1
    return _term_id


def post_id():
    global _post_id
    _post_id += 1
    return _post_id


__all__ = [term_id, post_id]
