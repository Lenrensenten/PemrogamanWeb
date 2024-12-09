document.addEventListener("DOMContentLoaded", () => {
    const gamesList = document.querySelector(".games-list");
    const contactForm = document.querySelector("#contactForm");
    const notification = document.querySelector("#notification");
    const commentsList = document.querySelector(".comments-list");
  
    // Fetch Games Data from API
    fetch("http://localhost:8000/api/api.php?table=games")
      .then(response => response.json())
      .then(data => {
        data.forEach(game => {
          const gameItem = document.createElement("div");
          gameItem.className = "game-item";
          gameItem.innerHTML = `
            <h3>${game.name}</h3>
            <p>${game.description}</p>
          `;
          gamesList.appendChild(gameItem);
        });
      })
      .catch(error => {
        console.error("Error fetching data:", error);
        const errorMessage = document.createElement("p");
        errorMessage.textContent = "Failed to load games. Please try again later.";
        gamesList.appendChild(errorMessage);
      });
  
    // Fetch Comments from API
    fetch("http://localhost:8000/api/api.php?table=comments")
      .then(response => response.json())
      .then(comments => {
        comments.forEach(comment => {
          const commentItem = document.createElement("div");
          commentItem.className = "comment-item";
          commentItem.innerHTML = `
            <p><strong>${comment.name}</strong>: ${comment.message}</p>
          `;
          commentsList.appendChild(commentItem);
        });
      })
      .catch(error => {
        console.error("Error fetching comments:", error);
        const errorMessage = document.createElement("p");
        errorMessage.textContent = "Failed to load comments. Please try again later.";
        commentsList.appendChild(errorMessage);
      });
  
    // Handle Contact Form Submission
    contactForm.addEventListener("submit", (event) => {
      event.preventDefault(); // Prevent form from submitting the usual way
  
      const name = document.querySelector("#name").value;
      const email = document.querySelector("#email").value;
      const message = document.querySelector("#message").value;
  
      const contactData = {
        name: name,
        email: email,
        message: message,
      };
  
      // Send comment to the backend API (POST)
      fetch("http://localhost:8000/api/api.php?table=comments", {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
        },
        body: JSON.stringify(contactData),
      })
        .then((response) => response.json())
        .then((data) => {
          if (data.message) {
            notification.textContent = "Thank you for your message!";
            contactForm.reset(); // Clear the form
          } else {
            notification.textContent = "Failed to send your message. Please try again.";
          }
        })
        .catch((error) => {
          console.error("Error submitting comment:", error);
          notification.textContent = "An error occurred. Please try again later.";
        });
    });
  });
  