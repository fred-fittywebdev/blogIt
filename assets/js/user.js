// 
// user.js
// Use this to write your custom JS
//

const paragraphs = document.querySelectorAll("article p");
const readTime = document.querySelector(".read-time");

const calculateReadTime = () => {
    let numberOfWords = 0;
    const average = 265;

    paragraphs.forEach(paragraph => {
        numberOfWords += paragraph.innerHTML.split(" ").length;
    });

    let readTimew = numberOfWords / average;

    readTime.innerHTML = "Temps de lecture estimé: " + Math.round(readTimew) + " minutes.";
    console.log(numberOfWords);
    console.log(readTime.innerHTML);

}

calculateReadTime();