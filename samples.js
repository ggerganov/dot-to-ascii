var samples = {
    "sample 0" :
`# sample 0

digraph {
    subgraph cluster_0 {
        a0 -> a1 -> a2 -> a3;
        label = "process \\#1";
    }

    subgraph cluster_1 {
        b0 -> b1 -> b2 -> b3;
        label = "process \\#2";
    }

    start -> a0;
    start -> b0;
    a1 -> b3;
    b2 -> a3;
    a3 -> a0;
    a3 -> end;
    b3 -> end;
}`,
    "sample 1" :
`# sample 1

digraph {
    a -> b;
    b -> c;
    b -> d;
}`,
    "sample 2" :
`# sample 2

graph {
    rankdir = LR;

    a -- b;
    b -- c;
    a -- c;
    d -- c;
    e -- c;
    e -- a;
}`,
    "sample 3" :
`# sample 3

digraph {
    a -> b [ label = "0.2" ];
    a -> c [ label = "0.4" ];
    c -> b [ label = "0.6" ];
    c -> e [ label = "0.6" ];
    e -> e [ label = "0.1" ];
    e -> b [ label = "0.7" ];
}`,
};
