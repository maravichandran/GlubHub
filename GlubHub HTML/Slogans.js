function slogans = {
	var slogans=[
	"There are plenty of FISH in the sea.",
	"This website is FIN-tastic!",
	"O-FISH-al fisherman network",
	"SEA-riously the best site ever!",
	"We’re not SQUID-ing!",
	"My favorite composer is Shostakofish",
	"The site you’ve all been HERRING about",
	"This site is BRILL-iant!",
	"In COD we trust.",
	"Get HOOKED on GlubHub",
	"The best PLAICE for fishermen",
	"A BETTA fishing experience",
	"This site is REEL-y great.",
	"The one place for all your Saquatic Ma news"
	];

	var index=Math.floor(Math.random()*14);
	document.getElementById("slogan").innerHTML=slogans[index];
};