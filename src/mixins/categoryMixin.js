const categoryMixin = {
    data: function () {
        return {
            categories: [],
            category: {},
        };
    },
    methods: {
        fetchCategories() {
            this.$emit("loadingEvent", true);

            this.$store
                .dispatch("category/getCategories")
                .then(() => {
                    this.categories = this.$store.getters["category/categories"];
                })
                .finally(() => {
                    this.$emit("loadingEvent", false);
                });
        },
    }
}
export default categoryMixin;