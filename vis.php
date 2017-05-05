<!DOCTYPE html>
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF8">
<title>NetVis</title>
<script type="text/javascript" src="vis/vis.js"></script>
<link type="text/css" rel="stylesheet" href="vis/vis-network.min.css">
<script type="text/javascript">
      function loadJSON(path, success, error) {
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function () {
          if (xhr.readyState === 4) {
            if (xhr.status === 200) {
              success(JSON.parse(xhr.responseText));
            }
            else {
              error(xhr);
            }
          }
        };
        xhr.open('GET', path, true);
        xhr.send();
      }
   </script>

<style type="text/css">
#mynetwork {
	width: 800px;
	height: 800px;
	border: 1px solid lightgray;
}

div.nodeContent {
	position: relative;
	border: 1px solid lightgray;
	width: 480px;
	height: 780px;
	margin-top: -802px;
	margin-left: 810px;
	padding: 10px;
}

pre {
	padding: 5px;
	margin: 5px;
}

.string {
	color: green;
}

.number {
	color: darkorange;
}

.boolean {
	color: blue;
}

.null {
	color: magenta;
}

.key {
	color: red;
}
</style>

</head>

<body>

	<h2>khubla.lan</h2>

	<div id="mynetwork"></div>
	<div class="nodeContent">
		<h4>Node Content:</h4>
		<pre id="nodeContent"></pre>
	</div>

	<script type="text/javascript">
  var network;

  var nodes = new vis.DataSet();
  var edges = new vis.DataSet();

  var nodeContent = document.getElementById('nodeContent');

  loadJSON('data.json', redrawAll, function(err) {console.log('error')});

  var container = document.getElementById('mynetwork');
  var data = {
    nodes: nodes,
    edges: edges
  };
  var options = {
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
        gravitationalConstant: -10000,
        springConstant: 0.002,
        springLength: 100
      }
    }
  };

  network = new vis.Network(container, data, options);
  network.on('click', function (params) {
    if (params.nodes.length > 0) {
      var data = nodes.get(params.nodes[0]); // get the data from selected node
      nodeContent.innerHTML = JSON.stringify(data, undefined, 3); // show the data in the div
    }
  })

  /**
   * This function fills the DataSets. These DataSets will update the network.
   */
  function redrawAll(json) {

    // clear old data
    nodes.clear();
    edges.clear();

    // add the parsed data to the DataSets.
    nodes.add(json.nodes);
    edges.add(json.edges);

    var data = nodes.get(2); // get the data from node 2 as example
    nodeContent.innerHTML = JSON.stringify(data,undefined,3); // show the data in the div
    network.fit(); // zoom to fit
  }

</script>


</body>
</html>
