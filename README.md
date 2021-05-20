# dot-to-ascii

Try it here: https://dot-to-ascii.ggerganov.com

![dot-to-ascii](https://i.imgur.com/3WLVWn3.png)

## API

Dot-to-ascii can be easily used in your code by performing https requests to the api.

### Python

```python
import requests


def dot_to_ascii(dot: str, fancy: bool = True):

    url = 'https://dot-to-ascii.ggerganov.com/dot-to-ascii.php'
    boxart = 0

    # use nice box drawing char instead of + , | , -
    if fancy:
        boxart = 1

    params = {
        'boxart': boxart,
        'src': dot,
    }

    response = requests.get(url, params=params).text

    if response == '':
        raise SyntaxError('DOT string is not formatted correctly')

    return response
```

``` python
graph_dot = '''
    graph {
        rankdir=LR
        0 -- {1 2}
        1 -- {2}
        2 -- {0 1 3}
        3
    }
'''

graph_ascii = dot_to_ascii(graph_dot)

print(graph_ascii)
```

```
                 ┌─────────┐
                 │         │
     ┌───┐     ┌───┐     ┌───┐     ┌───┐
  ┌─ │ 0 │ ─── │ 1 │ ─── │   │ ─── │ 3 │
  │  └───┘     └───┘     │   │     └───┘
  │    │                 │   │
  │    └──────────────── │ 2 │
  │                      │   │
  │                      │   │
  └───────────────────── │   │
                         └───┘
```
