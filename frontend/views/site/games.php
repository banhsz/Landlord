<?php

?>
<style>
    #game-container {
        position: relative;
        width: 400px;
        height: 400px;
        border: 1px solid #000;
        overflow: hidden;
    }
    #bird {
        position: absolute;
        width: 40px;
        height: 40px;
        background-color: yellow;
    }
    .pipe {
        position: absolute;
        width: 80px;
        background-color: green;
    }
</style>
<div id="game-container">
    <div id="bird"></div>
</div>
<button id="start-button">Start Game</button>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        const gameContainer = $("#game-container");
        const bird = $("#bird");
        const startButton = $("#start-button");

        let birdPosition = 200;
        let birdVelocity = 0;
        let jumping = false;
        let gameInterval;
        let score = 0;

        function startGame() {
            startButton.prop("disabled", true);
            birdPosition = 200;
            birdVelocity = 0;
            jumping = false;
            score = 0;
            gameInterval = setInterval(updateGame, 20);
        }

        function updateGame() {
            if (jumping) {
                birdVelocity = -6; // Adjust the jump strength as needed
                jumping = false;
            }

            birdVelocity += 0.2; // Adjust gravity as needed
            birdPosition += birdVelocity;
            bird.css("top", birdPosition + "px");

            if (birdPosition > gameContainer.height() - bird.height()) {
                clearInterval(gameInterval);
                alert("Game Over! Your score: " + score);
                startButton.prop("disabled", false);
            }

            $(".pipe").each(function() {
                const pipe = $(this);
                pipe.css("left", pipe.position().left - 2 + "px");

                if (isColliding(bird, pipe)) {
                    clearInterval(gameInterval);
                    alert("Game Over! Your score: " + score);
                    startButton.prop("disabled", false);
                }

                if (pipe.position().left < -pipe.width()) {
                    pipe.remove();
                }
            });

            if (birdPosition < 0) {
                birdPosition = 0;
            }

            if (birdPosition + bird.height() > gameContainer.height()) {
                birdPosition = gameContainer.height() - bird.height();
            }

            if (Math.random() < 0.02) {
                createPipe();
            }

            score++;
        }

        function createPipe() {
            const pipeHeight = Math.floor(Math.random() * 200) + 50;
            const pipeTop = Math.floor(Math.random() * (gameContainer.height() - pipeHeight));
            const pipeBottom = gameContainer.height() - pipeTop - pipeHeight;

            const pipe = $("<div class='pipe'></div>");
            pipe.css("height", pipeHeight + "px");
            pipe.css("top", pipeTop + "px");
            pipe.css("left", gameContainer.width() + "px");

            gameContainer.append(pipe);
        }

        function isColliding(element1, element2) {
            const rect1 = element1[0].getBoundingClientRect();
            const rect2 = element2[0].getBoundingClientRect();

            return (
                rect1.left < rect2.left + rect2.width &&
                rect1.left + rect1.width > rect2.left &&
                rect1.top < rect2.top + rect2.height &&
                rect1.top + rect1.height > rect2.top
            );
        }

        startButton.on("click", startGame);

        $(document).on("click", function() {
            jumping = true;
        });
    });
</script>

</script>