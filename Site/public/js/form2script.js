                let fonction = document.querySelector("#autre2"); //#commande_coating_fonction> option 

				console.log(fonction);
				fonction.addEventListener("click",inputtext);
				function inputtext() {
				   console.log('input');


				  let input = document.querySelector("#commande_coating_autrefonction");
                   input.setAttribute('type', 'text');
                   input.setAttribute('class', 'form-control');
                }


                
