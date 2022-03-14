var notify = document.querySelector(".notify");
var btn = document.querySelector(".btn");
notify.setAttribute('count', 0);
btn.addEventListener('click', press);

function press(){
  var add = Number(notify.getAttribute('count'));
  notify.setAttribute('count', add + 1);
  if (add === 0){
    notify.classList.add('numup');
  }
  false;
}
