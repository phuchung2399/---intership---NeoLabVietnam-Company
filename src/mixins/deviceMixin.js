
const deviceMixin = {
    data: function () {
        return {
            devices: [],
        };
    },
    methods: {
        fetchAllDevices() {
            this.$emit("loadingEvent", true);
            this.$store
                .dispatch("device/getDevices")
                .then(() => {
                    this.devices = this.$store.getters["device/devices"];
                })
                .finally(() => {
                    this.$emit("loadingEvent", false);
                });
        },

    }
}
export default deviceMixin;