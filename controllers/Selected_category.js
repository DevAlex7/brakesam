var id;
$(document).ready(function () {
    getCategory();
});
const getCategory = () => {
    id = localStorage.getItem('id_category');
} 