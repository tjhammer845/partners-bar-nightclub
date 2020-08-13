let instagramURL = 'https://api.instagram.com/v1/users/' + user + '/media/recent?access_token=' + accessToken;
console.log(instagramURL);

const getInstagramMedia = (data) => {
    const media = data.data;
    const fragment = document.createDocumentFragment();

    media.forEach(element => {
        const mediaClone = document.querySelector('#instagram-' + element.type).content.cloneNode(true);

        mediaClone.querySelector('a').href = element.link;
        if (element.caption !== null && element.caption.text !== null) {
            mediaClone.querySelector('a').title = element.caption.text;
        }
        mediaClone.querySelector('.image img').src = element.images.low_resolution.url;
        if (element.caption !== null && element.caption.text !== null) {
            mediaClone.querySelector('.image img').alt = element.caption.text;
        }
        mediaClone.querySelector('.user img').src = element.user.profile_picture;

        fragment.appendChild(mediaClone);
    });

    document.getElementById('instagram-media').appendChild(fragment);

    if (data.pagination.next_url !== undefined) {
        instagramURL = data.pagination.next_url;
        document.querySelector('.load-more').disabled = false;
    } else {
        document.querySelector('.load-more').parentNode.removeChild(document.querySelector('.load-more'));
    }
};

document.querySelector('.load-more').addEventListener('click', (event) => {
    event.target.disabled = true;

    getInstagramFeed(instagramURL);
});


const getInstagramFeed = (instagramURL) => {
    const validateResponse = (response) => {
        if (!response.ok) {
            throw Error(response.status, response.statusText);
        }

        return response;
    };
    const readResponseAsJSON = (response) => {
        return response.json();
    };
    const logResult = (result) => {
        console.log('And the results are in: \n', result);
    };
    const logError = (error) => {
        console.log('Looks like there was a problem: \n', error);
    };

    fetch(instagramURL)
        .then(validateResponse)
        .then(readResponseAsJSON)
        .then(getInstagramMedia)
        .catch(logError);
};
getInstagramFeed(instagramURL);

