function cbonclick(othis) {
    othis.parentNode.parentNode.style.textDecoration=
    othis.checked? 'line-through':'';
    othis.parentNode.parentNode.style.color=
    othis.checked? 'red':'';
    }