/*=============================================================================================
          This is the js file for the auth base layout
=============================================================================================*/
document.addEventListener('DOMContentLoaded', function() {
    // Function to generate random sprinkles
    function generateSprinkles(numberOfSprinkles) {
        const container = document.getElementById('sprinkles-container');
        const colors = ['#2c2c64', '#fc4b3b']; // Define the two colors

        for (let i = 0; i < numberOfSprinkles; i++) {
            const ball = document.createElement('div');
            
            // Random size between 10px and 40px
            const size = Math.random() * (40 - 10) + 10; 

            const color = colors[Math.floor(Math.random() * colors.length)]; // Random color

            // Random position on the sides (left or right)
            const side = Math.random() < 0.5 ? 'left' : 'right';  // Randomly choose left or right
            const positionTop = Math.random() * window.innerHeight;

            let positionLeft;
            if (side === 'left') {
                positionLeft = Math.random() * (window.innerWidth * 0.3); // 30% of the screen width
            } else {
                positionLeft = window.innerWidth - (Math.random() * (window.innerWidth * 0.3)); // 30% of the screen width on the right side
            }

            // Style the ball
            ball.style.position = 'absolute';
            ball.style.top = `${positionTop}px`;
            ball.style.left = `${positionLeft}px`;
            ball.style.width = `${size}px`;
            ball.style.height = `${size}px`;
            ball.style.backgroundColor = color;
            ball.style.borderRadius = '50%'; // Make it round
            ball.style.zIndex = '0'; // Low z-index so it's not on top of content
            ball.style.pointerEvents = 'none'; // Make sure they don't block interactions with the content

            // Append the ball to the container
            container.appendChild(ball);
        }
    }

    // Adjust the number of sprinkles based on screen width
    const screenWidth = window.innerWidth;

    // Generate a lower number of sprinkles on smaller screens (e.g., 15 on mobile, 30 on desktop)
    if (screenWidth < 768) {
        generateSprinkles(15);  // Mobile - fewer sprinkles
    } else {
        generateSprinkles(30);  // Desktop - more sprinkles
    }
});