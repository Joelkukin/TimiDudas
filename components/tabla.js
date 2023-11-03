/* $tabla= new Tabla([
        ["header1","header2","header3"],
        ["celdaA1","celdaA2","celdaA3"],
        ["celdaB1","celdaB2","celdaB3"],
        ["celdaC1","celdaC2","celdaC3"]
    ]); 
    
    <table class="table table-dark text-white rounded container">
        <thead>
            <tr>
                <th scope="col"> Codigo </th>
                <th scope="col"> Descripcion </th>
                <th scope="col"> Cantidad </th>
                <th scope="col"> Precio Unit. </th>
            </tr>
        </thead>
        <tbody id="tabla" cantfilas="1">
            
                <tr class="border border-top-0" id="row-0">
                    <td class="p-0">
                        <input class="form-control rounded-0 d-flex w-100" type="number" name="codigo[]" id="codigo-0">
                        </td>
                    <td class="p-0">
                        <input class="form-control rounded-0 d-flex w-100" type="text" name="descripcion[]" id="descripcion-0">
                        </td>
                    <td class="p-0">
                        <input class="form-control rounded-0 d-flex w-100" type="number" name="cantidad[]" id="cantidad-0">
                        </td>
                    <td class="p-0">
                        <input class="form-control rounded-0 d-flex w-100" type="number" name="precio[]" id="precio-0">
                    </td>
                </tr>
        </tbody>
        </table>*/

class Tabla {
    constructor(plantilla=array()) {
        let headers = this.arrayToHtml(plantilla[0],"tr","th");
    }
    arrayToHtml(valores,tagGroup,tagElement) {
        crearTag=(string,contenido)=>{

            /* separar atributos de tags */
            [containerHtml, ...atributos] = string.split(" "); // todo string
            containerHtml = document.createElement(containerHtml);

            /* Asignar Atributos al container*/
            atributos.forEach((atr)=>{
                if (atr.includes('=')) {
                    let [nombreAtributo, valorAtributo]=atr.split('=');
                    tag.setAttribute(nombreAtributo,valorAtributo);
                }
            });

            /* insertar contenido en el tag */
            container.innerHTML=contenido;
        }




        valores.forEach(valor=>{
            tagGroup.appendChild(tagElement.innerHTML=valor);
        });
        return tagGroup;
    }
}