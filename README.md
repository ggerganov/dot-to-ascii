# dot-to-ascii

Try it here: https://dot-to-ascii.ggerganov.com

![dot-to-ascii](https://i.imgur.com/3WLVWn3.png)

## How it works?

- The [index.html](index.html#L82-L95) page sends XHR requests containing your Graphviz input to the [dot-to-ascii.php](dot-to-ascii.php) script
- The [dot-to-ascii.php](dot-to-ascii.php#L8) script runs the [Graph::Easy](https://metacpan.org/pod/Graph::Easy) command line tool to produce a text diagram from the provided Graphviz input
- The result is returned back to [index.html](index.html#L82-L95) where it is displayed in a `<pre>` tag

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
