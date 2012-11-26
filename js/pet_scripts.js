function initialize() {
	map = new google.maps.Map(document.getElementById('map'), {
		zoom: 12,
		center: new google.maps.LatLng(38.898748, -77.037684),
		mapTypeId: google.maps.MapTypeId.ROADMAP
	});
}