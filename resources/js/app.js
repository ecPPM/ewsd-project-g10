import "./bootstrap";

// <script>
const toggleCollapse = () => {
    const element = document.getElementById("edit-collapse");
    console.log(element.classList.contains("collapse-open"));
    if (element.classList.contains("collapse-open")) {
        element.classList.remove("collapse-open");
    } else {
        element.classList.add("collapse-open");
    }
};
// </script>
