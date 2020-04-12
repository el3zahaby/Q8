export const mapMixin = {
    data() {
        return {
            latitude: null,
            longitude: null,
            map: null,
            marker: false
        };
    },
    computed: {
        address() {
            if (this.latitude) {
                return `lat: ${this.latitude}, lng: ${this.longitude}`;
            }
            else {
                return '';
            }
        }
    },
    methods: {
        initMap: function () {
            var vm = this;
            vm.map = new google.maps.Map(document.getElementById("map"), {
                center: { lat: 30.033333, lng: 31.233334 },
                zoom: 8,
                mapTypeId: "roadmap"
            });

            // Try HTML5 geolocation.
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function(position) {
                    var pos = {
                        lat: position.coords.latitude,
                        lng: position.coords.longitude
                    };
                    vm.map.setCenter(pos);
                    vm.map.setZoom(15);
                    vm.marker = new google.maps.Marker({
                        position: pos,
                        map: vm.map,
                        draggable: true
                    });
                    vm.latitude = vm.marker.getPosition().lat();
                    vm.longitude = vm.marker.getPosition().lng();
                });
            }

            vm.map.addListener("click", function(event) {
                if (vm.marker !== false) {
                    vm.marker.setPosition(event.latLng);
                } else {
                    vm.addMarker(event.latLng);
                }
            });


        },
        addMarker: function (location) {
            var vm = this;
            this.marker = new google.maps.Marker({
                position: location,
                map: vm.map,
                draggable: true
            });
        },
        getAddressInfo() {
            this.latitude = this.marker.getPosition().lat();
            this.longitude = this.marker.getPosition().lng();
            console.log(this.marker.getPosition().lat());
            console.log(this.marker.getPosition().lng());
        }
    },
    mounted() {
        $('#address').focus(function(){
            //open bootsrap modal
            $('#mapModal').modal({
                show: true
            });
        });

        this.initMap();
    }
};
