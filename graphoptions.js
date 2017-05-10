 var options = {
            width: '100%',
            height: '100%',
            nodes: {
                shape: 'circle',
                font: {
                    face: 'Tahoma'
                }
            },
            edges: {
                width: 0.5,
                smooth: {
                    type: 'continuous'
                }
            },
            interaction: {
                tooltipDelay: 200,
                hideEdgesOnDrag: true
            },
            physics: {
                stabilization: false,
                barnesHut: {
                    gravitationalConstant: -1500,
                    springConstant: 0.002,
                    springLength: 10
                }
            },
            layout: {
                randomSeed: 0.77
            }
        };