



/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import './styles/app.css';
import './styles/global.scss';

// start the Stimulus application




const addFormToCollection = (e) => {
    const collectionHolder = document.querySelector('.' + e.currentTarget.dataset.collectionHolderClass);
console.log('collectionHolder')
    const item = document.createElement('div');
    item.className ='col-span-1'
    item.innerHTML = collectionHolder
        .dataset
        .prototype
        .replace(
            /__name__/g,
            collectionHolder.dataset.index
        );
    item.querySelector(".btn-remove").addEventListener("click", () => item.remove());
    collectionHolder.appendChild(item);

    collectionHolder.dataset.index++;
    // add a delete link to the new form

};




document
    .querySelectorAll('.btn-remove')
    .forEach(btn => btn.addEventListener("click", (e) => e.currentTarget.closest(".col-4").remove()));


document
    .querySelectorAll('.add_item_link')
    .forEach(btn => btn.addEventListener("click", addFormToCollection));