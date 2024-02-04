<template>
    <div class="star-rating">
        <input
            id="5-stars"
            type="radio"
            name="rating"
            value="5"
            disabled
            checked
        />
        <label for="5-stars" class="star">&#9733;</label>
        <input id="4-stars" type="radio" name="rating" value="4" disabled />
        <label for="4-stars" class="star">&#9733;</label>
        <input id="3-stars" type="radio" name="rating" value="3" disabled />
        <label for="3-stars" class="star">&#9733;</label>
        <input id="2-stars" type="radio" name="rating" value="2" disabled />
        <label for="2-stars" class="star">&#9733;</label>
        <input id="1-star" type="radio" name="rating" value="1" disabled />
        <label for="1-star" class="star">&#9733;</label>
    </div>
</template>

<style scoped>
.star-rating {
    display: flex;
    flex-direction: row-reverse;
    font-size: 1.5em;
    justify-content: space-around;
    padding: 0 0.2em;
    text-align: center;
    width: 5em;
}

.star-rating input {
    display: none;
}

.star-rating label {
    color: #ccc;
    cursor: pointer;
}

.star-rating :checked ~ label {
    color: #f90;
}

.star-rating label:hover,
.star-rating label:hover ~ label {
    color: #fc0;
}

/* explanation */

article {
    background-color: #ffe;
    box-shadow: 0 0 1em 1px rgba(0, 0, 0, 0.25);
    color: #006;
    font-family: cursive;
    font-style: italic;
    margin: 4em;
    max-width: 30em;
    padding: 2em;
}
</style>
