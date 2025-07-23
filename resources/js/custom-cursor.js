document.addEventListener("DOMContentLoaded", () => {
    const cursorDot = document.getElementById("cursor-dot");
    const cursorOutline = document.getElementById("cursor-outline");

    if (cursorDot && cursorOutline) {
        let mouseX = 0;
        let mouseY = 0;
        let dotX = 0;
        let dotY = 0;
        let outlineX = 0;
        let outlineY = 0;
        let isFirstMove = true;

       
        window.addEventListener("mousemove", (e) => {
            mouseX = e.clientX;
            mouseY = e.clientY;

            
            if (isFirstMove) {
                dotX = mouseX;
                dotY = mouseY;
                outlineX = mouseX;
                outlineY = mouseY;
                cursorDot.style.opacity = '1';
                cursorOutline.style.opacity = '1';
                isFirstMove = false;
            }
        });

        
        const animateCursor = () => {
        
            dotX = mouseX;
            dotY = mouseY;
            cursorDot.style.left = `${dotX}px`;
            cursorDot.style.top = `${dotY}px`;
            
            // Gerakan lingkaran luar (dengan efek delay/tertinggal)
            outlineX += (mouseX - outlineX) * 0.1;
            outlineY += (mouseY - outlineY) * 0.1;
            cursorOutline.style.left = `${outlineX}px`;
            cursorOutline.style.top = `${outlineY}px`;

            requestAnimationFrame(animateCursor);
        };
        
        animateCursor(); // Mulai animasi

        // Efek hover
        const interactiveElements = document.querySelectorAll('a, button, .cursor-pointer');
        interactiveElements.forEach((el) => {
            el.addEventListener('mouseover', () => cursorOutline.classList.add('hover'));
            el.addEventListener('mouseout', () => cursorOutline.classList.remove('hover'));
        });
    }
});