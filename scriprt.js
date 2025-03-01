// Array of images
const images = ["images/001.jpg", "images/e03.jpg"];

// Select a random image
const randomImage = images[Math.floor(Math.random() * images.length)];

// Apply random image to the src attribute
const imageElement = document.getElementById("randomImage");
imageElement.src = randomImage;

// Fallback in case the image doesn't load (for testing)
imageElement.onerror = function() {
    imageElement.src = "images/fallback.jpg"; // Set a fallback image
};
