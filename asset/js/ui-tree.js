var UITree = function () {

    return {
        //main function to initiate the module
        init: function () {
            // handle collapse/expand for tree_1
            $('#role-tree-collapse').click(function () {
                $('.tree-toggle', $('#role-tree > li > ul')).addClass("closed");
                $('.branch', $('#role-tree > li > ul')).removeClass("in");
            });

            $('#role-tree-expand').click(function () {
                $('.tree-toggle', $('#role-tree > li > ul')).removeClass("closed");
                $('.branch', $('#role-tree > li > ul')).addClass("in");
            });

            //This is a quick example of capturing the select event on tree leaves, not branches
            $("#role-tree").on("nodeselect.tree.data-api", "[data-role=leaf]", function (e) {
                var output = "Node nodeselect event fired:\nNode Type: leaf\nValue: " + ((e.node.value) ? e.node.value : e.node.el.text()) + "\nParentage: " + e.node.parentage.join("/");

                alert(output);
            });

            //This is a quick example of capturing the select event on tree branches, not leaves
            $("#role-tree").on("nodeselect.tree.data-api", "[role=branch]", function (e) {
                var output = "Node nodeselect event fired:\n"; + "Node Type: branch\n" + "Value: " + ((e.node.value) ? e.node.value : e.node.el.text()) + "\n" + "Parentage: " + e.node.parentage.join("/") + "\n"

                alert(output);
            });

            //Listening for the 'openbranch' event. Look for e.node, which is the actual node the user opens

            $("#role-tree").on("openbranch.tree", "[data-toggle=branch]", function (e) {

                var output = "Node openbranch event fired:\n" + "Node Type: branch\n" + "Value: " + ((e.node.value) ? e.node.value : e.node.el.text()) + "\n" + "Parentage: " + e.node.parentage.join("/") + "\n"

                alert(output);
            });


            //Listening for the 'closebranch' event. Look for e.node, which is the actual node the user closed

            $("#role-tree").on("closebranch.tree", "[data-toggle=branch]", function (e) {

                var output = "Node closebranch event fired:\n" + "Node Type: branch\n" + "Value: " + ((e.node.value) ? e.node.value : e.node.el.text()) + "\n" + "Parentage: " + e.node.parentage.join("/") + "\n"

                alert(output);
            });
        }

    };

}();