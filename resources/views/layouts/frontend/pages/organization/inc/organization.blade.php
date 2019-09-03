<style>
	#tree {
        width: 100%;
        height: 100%;
        position: relative;
    }
</style>
<div id="tree">
</div>
 <script>
 	var chart = new OrgChart(document.getElementById("tree"), {
        template: "ula",
        enableSearch: false,
        mouseScrool: OrgChart.action.none,
        nodeBinding: {
            field_0: "name",
            field_1: "title",
            img_0: "img"
        },
        nodes: [
            { id: 1, name: "Amber McKenzie", title: "CEO", img: "//balkangraph.com/js/img/empty-img-white.svg" },
            { id: 2, pid: 1, name: "Ava Field", title: "IT Manager", img: "//balkangraph.com/js/img/empty-img-white.svg"},
            { id: 3, pid: 1, name: "Rhys Harper", img: "//balkangraph.com/js/img/empty-img-white.svg" }
        ]
    });    
 </script>