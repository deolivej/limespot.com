window.LimeSpot = window.LimeSpot === undefined ? {} : LimeSpot;

LimeSpot.renderKbToc = function (current) {
	var page = window.location.pathname.replace("/index.html", "");//.replace("//kb.limespot.com/", "");
	if (page[page.length - 1] == "/") {
		page = page.substring(0, page.length - 1);
	}

	var path = page.split("/");
	page = path[path.length - 1];

	$(".ls-kb-toc").load("//kb.limespot.com/toc.html", function () {
		$(this).find("a").filter(function () {
			var href = $(this).attr("href");
			return href.endsWith("/" + page) || href.endsWith("/" + page + "/");
		}).parents("li").addClass("active");
	});
	var breadcrumbs = $("<ol>").addClass("breadcrumb");
	var trail = "";
	$("<li>").append($("<a>", { href: "//kb.limespot.com" }).text("Knowledge Base")).appendTo(breadcrumbs);
	for (var i = 0; i < path.length; i++) {
		var p = path[i];
		if (p == "" || p.toLowerCase() == "kb")
			continue;

		trail += "/" + p;
		var crumb = p.split("-").join(" ");

		$("<li>").append($("<a>", { href: trail }).text(crumb)).appendTo(breadcrumbs);
	}
	breadcrumbs.find("li").last().addClass("active");
	$(".ls-kb-content").prepend(breadcrumbs);
}