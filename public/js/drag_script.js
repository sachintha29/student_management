
(function() {
    "use strict";

  const table = document.getElementById('drag_table');
  const tbody = table.querySelector('tbody');



  var currRow = null,
      dragElem = null,
      mouseDownX = 0,
      mouseDownY = 0,
      mouseX = 0,
      mouseY = 0,
      mouseDrag = false;

  function init() {
    bindMouse();
  }

  function bindMouse() {
    document.addEventListener('mousedown', (event) => {
      if(event.button != 0) return true;

      let target = getTargetRow(event.target);
      if(target) {
        currRow = target;
        addDraggableRow(target);
        currRow.classList.add('is-dragging');


        let coords = getMouseCoords(event);
        mouseDownX = coords.x;
        mouseDownY = coords.y;

        mouseDrag = true;

         // Prevent scrolling
         document.body.style.overflow = 'hidden';
      }
    });

    document.addEventListener('mousemove', (event) => {
      if(!mouseDrag) return;

      let coords = getMouseCoords(event);
      mouseX = coords.x - mouseDownX;
      mouseY = coords.y - mouseDownY;

      moveRow(mouseX, mouseY);
    });

    document.addEventListener('mouseup', (event) => {
      if(!mouseDrag) return;

      currRow.classList.remove('is-dragging');
      table.removeChild(dragElem);

      dragElem = null;
      mouseDrag = false;

      // Enable scrolling
      document.body.style.overflow = '';

      console.log('event triggered');

        getOrder();


    });
  }


    function getOrder() {
        var elements = document.getElementsByClassName('order');

        for (var i = 0; i < elements.length; i++) {
            // Access each element using elements[i]
            var currentElement = elements[i];
            // Get the value of the 'data-key' attribute for each element
            var IDValue = currentElement.getAttribute('data-id');
            var OrderValue = currentElement.getAttribute('data-order');
            // console.log(IDValue,OrderValue,i+1);
            var NewOrderValue = i+1;

            var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            axios.post('/update-question-order', {
                data: {
                      'IDValue': IDValue,
                      'OrderValue': OrderValue,
                       'NewOrderValue' : NewOrderValue,
                }
            }, {
                headers: {
                    'X-CSRF-TOKEN': csrfToken // Set the CSRF token in the request headers
                }
            })
                .then(function (response) {
                    // Handle success
                    console.log(response);
                })
                .catch(function (error) {
                    // Handle error
                    console.error(error);
                });




        }
    }




    function swapRow(row, index) {
     let currIndex = Array.from(tbody.children).indexOf(currRow),
         row1 = currIndex > index ? currRow : row,
         row2 = currIndex > index ? row : currRow;

     tbody.insertBefore(row1, row2);
  }

  function moveRow(x, y) {
    dragElem.style.transform = "translate3d(" + x + "px, " + y + "px, 0)";

    let	dPos = dragElem.getBoundingClientRect(),
        currStartY = dPos.y, currEndY = currStartY + dPos.height,
        rows = getRows();

    for(var i = 0; i < rows.length; i++) {
      let rowElem = rows[i],
          rowSize = rowElem.getBoundingClientRect(),
          rowStartY = rowSize.y, rowEndY = rowStartY + rowSize.height;

      if(currRow !== rowElem && isIntersecting(currStartY, currEndY, rowStartY, rowEndY)) {
        if(Math.abs(currStartY - rowStartY) < rowSize.height / 2)
          swapRow(rowElem, i);
      }
    }
  }

  function addDraggableRow(target) {
      dragElem = target.cloneNode(true);
      dragElem.classList.add('draggable-table__drag');
      dragElem.style.height = getStyle(target, 'height');
      dragElem.style.background = getStyle(target, 'backgroundColor');
      for(var i = 0; i < target.children.length; i++) {
        let oldTD = target.children[i],
            newTD = dragElem.children[i];
        newTD.style.width = getStyle(oldTD, 'width');
        newTD.style.height = getStyle(oldTD, 'height');
        newTD.style.padding = getStyle(oldTD, 'padding');
        newTD.style.margin = getStyle(oldTD, 'margin');
      }

      table.appendChild(dragElem);


      let tPos = target.getBoundingClientRect(),
          dPos = dragElem.getBoundingClientRect();
      dragElem.style.bottom = ((dPos.y - tPos.y) - tPos.height) + "px";
      dragElem.style.left = "-1px";

      document.dispatchEvent(new MouseEvent('mousemove',
        { view: window, cancelable: true, bubbles: true }
      ));
  }







  function getRows() {
    return table.querySelectorAll('tbody tr');
  }

  function getTargetRow(target) {
      let elemName = target.tagName.toLowerCase();

      if(elemName == 'tr') return target;
      if(elemName == 'td') return target.closest('tr');
  }

  function getMouseCoords(event) {
    return {
        x: event.clientX,
        y: event.clientY
    };
  }

  function getStyle(target, styleName) {
    let compStyle = getComputedStyle(target),
        style = compStyle[styleName];

    return style ? style : null;
  }

  function isIntersecting(min0, max0, min1, max1) {
      return Math.max(min0, max0) >= Math.min(min1, max1) &&
             Math.min(min0, max0) <= Math.max(min1, max1);
  }



  init();

})();
