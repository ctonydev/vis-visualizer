<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF8">
    <title>NetVis</title>
    <script type="text/javascript" src="assets/vis/vis.js"></script>
    <script type="text/javascript" src="assets/js/loadjson.js"></script>
    <link type="text/css" rel="stylesheet" href="assets/vis/vis-network.min.css">
    <link type="text/css" rel="stylesheet" href="assets/css/netvis.css">
    <meta http-equiv="refresh" content="60">
</head>
<body>
    <div id="mynetwork"></div>

    <script type="text/javascript">
        var network;

        var nodes = new vis.DataSet();
        var edges = new vis.DataSet();

        var nodeContent = document.getElementById('nodeContent');

        loadJSON('dataserver.php', redrawAll, function(err) {
            console.log('error')
        });

        var container = document.getElementById('mynetwork');
        var data = {
            nodes: nodes,
            edges: edges
        };

        <?php include "graphoptions.js" ?>
       
        network = new vis.Network(container, data, options);
        network.on('click', function(params) {})

        /**
         * This function fills the DataSets. These DataSets will update the network.
         */
        function redrawAll(json) {

 //           console.log(json);

            // clear old data
            nodes.clear();
            edges.clear();

            // add the parsed data to the DataSets.
            nodes.add(json.nodes);
            edges.add(json.edges);

            var data = nodes.get(2); // get the data from node 2 as example
            network.fit(); // zoom to fit
        }
    </script>
</body>
</html>
