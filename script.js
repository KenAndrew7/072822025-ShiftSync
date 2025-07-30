document.getElementById('login-form').addEventListener('submit', function (e) {
    e.preventDefault();
    alert('Login submitted!');
  });
// Simple example for interaction
console.log("Dashboard loaded.");

document.querySelectorAll("nav li").forEach(item => {
  item.addEventListener("click", () => {
    document.querySelectorAll("nav li").forEach(el => el.classList.remove("active"));
    item.classList.add("active");
  });
});

// Toggle active tabs
document.querySelectorAll(".task-tabs span").forEach(tab => {
    tab.addEventListener("click", () => {
      document.querySelectorAll(".task-tabs span").forEach(t => t.classList.remove("active"));
      tab.classList.add("active");
    });
  });
  