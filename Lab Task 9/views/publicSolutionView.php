<?php
require '../controllers/ajax_publicSolutionView.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Solutions</title>
    <style>
        .solutionImage{
            width: 200px;
            height: 200px;
            border: 1px solid black;
            margin: 10px;
        }
        .solution{
            display: flex;
            flex-direction: row;
            justify-content: space-between;
            border: 1px solid black;
            padding: 10px;
            margin: 10px;
            cursor: pointer;
        }
        .solutionDetails{
            width: 100%;
            margin-left: 10px;
        }
        .pagination{
            display: flex;
            flex-direction: row;
            justify-content: center;
            align-items: center;
        }
        
        
    </style>
    <script>

        const solutionTypes={};
        const sectors={};
        const regions={};
        const sort = {type:'newest'};
        let page = 1;

        function loadData(){
            loadSolutionTypes();
            loadSectors();
            loadRegions();
            loadSolutions();
        }

        function loadSolutions(){
            page = 1;
            document.getElementById("pagination").innerHTML = "<b><label onclick='loadMore()' style='color:blue;'>Load More</label></b>";
            const filters = JSON.stringify(solutionTypes) + "(%)" + JSON.stringify(sectors) + "(%)" + JSON.stringify(regions) + "(%)" + JSON.stringify(sort)+"(%)"+page;
            //console.log(filters);
            const xhttp = new XMLHttpRequest();
            xhttp.onload = function(){
                if(this.status == 200){
                    //console.log(this.responseText);
                    const jsonData = JSON.parse(this.responseText);
                    //console.log(jsonData);
                    let solutions = document.getElementById("solutions");
                    solutions.innerHTML = "";
                    for(const item of jsonData){
                        const div = document.createElement("div");
                        div.className = "solution";
                        const div2 = document.createElement("div");
                        div2.className = "solutionImage";
                        const img = document.createElement("img");
                        img.src = item.media?item.media:"";
                        img.height = 200;
                        img.width = 200;
                        div2.appendChild(img);
                        div.appendChild(div2);
                        const div3 = document.createElement("div");
                        div3.className = "solutionDetails";
                        const h3 = document.createElement("h3");
                        const xhttp1 = new XMLHttpRequest();
                        xhttp1.onload = function(){
                            if(this.status == 200){
                                //console.log(this.responseText);
                                const jsonData1 = JSON.parse(this.responseText);
                                //console.log(jsonData1);
                                h3.innerHTML = jsonData1.organizationName;
                            }
                        }
                        xhttp1.open("POST", "../controllers/ajax_publicSolutionView.php", true);
                        xhttp1.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                        xhttp1.send("username="+item.username); 
                        div3.appendChild(h3);
                        //div3.appendChild(document.createElement("br"));
                        const h33 = document.createElement("h3");
                        h33.innerHTML = item.solutionType;
                        div3.appendChild(h33);
                        const h31 = document.createElement("h3");
                        const xhttp2 = new XMLHttpRequest();
                        xhttp2.onload = function(){
                            if(this.status == 200){
                                //console.log(this.responseText);
                                const jsonData2 = JSON.parse(this.responseText);
                                //console.log(jsonData2);
                                for(const itemi of jsonData2){
                                    h31.innerHTML += "|"+itemi.sector+"|";
                                }
                            }
                        }
                        xhttp2.open("POST", "../controllers/ajax_publicSolutionView.php", true);
                        xhttp2.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                        xhttp2.send("solutionId="+item.solutionID);
                        div3.appendChild(h31);
                        //div3.appendChild(document.createElement("br"));
                        const h32 = document.createElement("h3");
                        h32.innerHTML = item.title;
                        div3.appendChild(h32);
                        //div3.appendChild(document.createElement("br"));
                        const p = document.createElement("p");
                        //p.innerHTML = item.challenge;
                        div3.appendChild(p);
                        div.appendChild(div3);
                        div.addEventListener("click", function(){
                            window.location.href = "solutionDetails.php?solutionId="+item.solutionID;
                        });
                        solutions.appendChild(div);
                        //solutions.appendChild(document.createElement("hr"));
                    }
                
                }
            }
            xhttp.open("GET", "../controllers/ajax_publicSolutionView.php?req="+filters, true);
            xhttp.send();
        }

        function loadSolutionTypes(){
            const xhttp = new XMLHttpRequest();    
            xhttp.onload = function(){
                if(this.status == 200){
                    //console.log(this.responseText);
                    const jsonData = JSON.parse(this.responseText);
                    let allSolutionsCheckBox = document.getElementById("allSolutionsCheckBox");
                    for(const item of jsonData){
                        const checkbox = document.createElement("input");
                        checkbox.type = "checkbox";
                        checkbox.name = item.name;
                        checkbox.addEventListener("click", function(){
                            if(this.checked){
                                solutionTypes[checkbox.name] = checkbox.name;
                                let solTypeLabel = document.getElementById("allSolutionsLabel");
                                if(solTypeLabel.innerHTML == "All Solutions"){
                                    solTypeLabel.innerHTML = "";
                                }
                                solTypeLabel.innerHTML += "|"+checkbox.name + "|";
                            } else {
                                delete solutionTypes[checkbox.name];
                                let solTypeLabel = document.getElementById("allSolutionsLabel");
                                solTypeLabel.innerHTML = solTypeLabel.innerHTML.replace("|"+checkbox.name + "|", "");
                                if(solTypeLabel.innerHTML == ""){
                                    solTypeLabel.innerHTML = "All Solutions";
                                }
                            }
                            loadSolutions();
                            //console.log(solutionTypes);
                        });
                        const label = document.createElement("label");
                        label.for = item.name;
                        label.innerHTML = item.name+"<br>";
                        allSolutionsCheckBox.appendChild(checkbox);
                        allSolutionsCheckBox.appendChild(label);
                        //allSolutionsCheckBox.appendChild(document.createElement("br"));
                    }
                } else {
                    console.error('Error:', xhttp.status, xhttp.statusText);
                }
            }
            xhttp.open("GET", "../controllers/ajax_publicSolutionView.php?req=allSolutions");
            xhttp.send();
        }
        function loadSectors(){
            const xhttp = new XMLHttpRequest();    
            xhttp.onload = function(){
                if(this.status == 200){
                    //console.log(this.responseText);
                    const jsonData = JSON.parse(this.responseText);
                    //console.log(jsonData);
                    let allSectorsCheckBox = document.getElementById("allFocusAreasCheckBox");
                    for(const item of jsonData){
                        const checkbox = document.createElement("input");
                        checkbox.type = "checkbox";
                        checkbox.name = item.name;
                        checkbox.addEventListener("click", function(){
                            if(this.checked){
                                sectors[checkbox.name] = checkbox.name;
                                let sectorLabel = document.getElementById("allFocusAreasLabel");
                                if(sectorLabel.innerHTML == "All Focus Areas"){
                                    sectorLabel.innerHTML = "";
                                }
                                sectorLabel.innerHTML += "|"+checkbox.name + "|";
                            } else {
                                delete sectors[checkbox.name];
                                let sectorLabel = document.getElementById("allFocusAreasLabel");
                                sectorLabel.innerHTML = sectorLabel.innerHTML.replace("|"+checkbox.name + "|", "");
                                if(sectorLabel.innerHTML == ""){
                                    sectorLabel.innerHTML = "All Focus Areas";
                                }
                            }
                            loadSolutions();
                        });
                        const label = document.createElement("label");
                        label.for = item.name;
                        label.innerHTML = item.name+"<br>";
                        allSectorsCheckBox.appendChild(checkbox);
                        allSectorsCheckBox.appendChild(label);
                        //allSectorsCheckBox.appendChild(document.createElement("br"));
                    }
                } else {
                    console.error('Error:', xhttp.status, xhttp.statusText);
                }
            }
            xhttp.open("GET", "../controllers/ajax_publicSolutionView.php?req=allSectors");
            xhttp.send();
        }
        function loadRegions(){
            const xhttp = new XMLHttpRequest();    
            xhttp.onload = function(){
                if(this.status == 200){
                    //console.log(this.responseText);
                    const jsonData = JSON.parse(this.responseText);
                    let allRegionsCheckBox = document.getElementById("allRegionsCheckBox");
                    for(const item of jsonData){
                        const checkbox = document.createElement("input");
                        checkbox.type = "checkbox";
                        checkbox.name = item.region;
                        checkbox.addEventListener("click", function(){
                            if(this.checked){
                                regions[checkbox.name] = checkbox.name;
                                let regionLabel = document.getElementById("allRegionsLabel");
                                if(regionLabel.innerHTML == "All Regions"){
                                    regionLabel.innerHTML = "";
                                }
                                regionLabel.innerHTML += "|"+checkbox.name + "|";
                            } else {
                                delete regions[checkbox.name];
                                let regionLabel = document.getElementById("allRegionsLabel");
                                regionLabel.innerHTML = regionLabel.innerHTML.replace("|"+checkbox.name + "|", "");
                                if(regionLabel.innerHTML == ""){
                                    regionLabel.innerHTML = "All Regions";
                                }
                            }
                            loadSolutions();
                        });
                        const label = document.createElement("label");
                        label.for = item.region;
                        label.innerHTML = item.region+"<br>";
                        allRegionsCheckBox.appendChild(checkbox);
                        allRegionsCheckBox.appendChild(label);
                        //allRegionsCheckBox.appendChild(document.createElement("br"));
                    }
                } else {
                    console.error('Error:', xhttp.status, xhttp.statusText);
                }
            }
            xhttp.open("GET", "../controllers/ajax_publicSolutionView.php?req=allRegions");
            xhttp.send();
        }
        function allSolutionsFilter(){
            document.getElementById("allSolutionsHidden").hidden = !document.getElementById("allSolutionsHidden").hidden;
            //console.log(solutionTypes);
        }
        function allFocusAreasFilter(){
            document.getElementById("allFocusAreasHidden").hidden = !document.getElementById("allFocusAreasHidden").hidden;
            //console.log(sectors);
        }
        function allRegionsFilter(){
            document.getElementById("allRegionsHidden").hidden = !document.getElementById("allRegionsHidden").hidden;
            //console.log(regions);
        }

        function searchSectors(){
            let input = document.getElementById("allFocusAreas");
            input = input.value.toLowerCase();
            let container = document.getElementById("allFocusAreasCheckBox");
            let items = container.getElementsByTagName("input");
            let itemLabels = container.getElementsByTagName("label");
            for (let i = 0; i < items.length; i++) {
                let itemName = itemLabels[i].innerHTML;
                if (itemName.toLowerCase().indexOf(input) > -1) {
                    items[i].hidden = false;
                    itemLabels[i].hidden = false;
                } else {
                    items[i].hidden = true;
                    itemLabels[i].hidden = true;
                }
            }
        }

        function searchSolutionTypes(){
            let input = document.getElementById("allSolutions");
            input = input.value.toLowerCase();
            let container = document.getElementById("allSolutionsCheckBox");
            let items = container.getElementsByTagName("input");
            let itemLabels = container.getElementsByTagName("label");
            for (let i = 0; i < items.length; i++) {
                let itemName = itemLabels[i].innerHTML;
                if (itemName.toLowerCase().indexOf(input) > -1) {
                    items[i].hidden = false;
                    itemLabels[i].hidden = false;
                } else {
                    items[i].hidden = true;
                    itemLabels[i].hidden = true;
                }
            }
        }

        function searchRegions(){
            let input = document.getElementById("allRegions");
            input = input.value.toLowerCase();
            let container = document.getElementById("allRegionsCheckBox");
            let items = container.getElementsByTagName("input");
            let itemLabels = container.getElementsByTagName("label");
            for (let i = 0; i < items.length; i++) {
                let itemName = itemLabels[i].innerHTML;
                if (itemName.toLowerCase().indexOf(input) > -1) {
                    items[i].hidden = false;
                    itemLabels[i].hidden = false;
                } else {
                    items[i].hidden = true;
                    itemLabels[i].hidden = true;
                }
            }
        }

        function doSort(){
            let s = document.getElementById("sortA");
            let sortA = s.options[s.selectedIndex].value;
            sort['type'] = sortA;
            loadSolutions();
            //console.log(sort);
        }

        function loadMore(){
            page+=1;
            const filters = JSON.stringify(solutionTypes) + "(%)" + JSON.stringify(sectors) + "(%)" + JSON.stringify(regions) + "(%)" + JSON.stringify(sort)+"(%)"+page;
            //console.log(filters);
            const xhttp = new XMLHttpRequest();
            xhttp.onload = function(){
                if(this.status == 200){
                    console.log(this.responseText);
                    if(this.responseText==="[]"){
                        document.getElementById("pagination").innerHTML = "<b><label style='color:blue;'>No more solutions</label></b>";
                        return;
                    }
                    const jsonData = JSON.parse(this.responseText);
                    
                    //console.log(jsonData);
                    let solutions = document.getElementById("solutions");
                    //solutions.innerHTML = "";
                    for(const item of jsonData){
                        const div = document.createElement("div");
                        div.className = "solution";
                        const div2 = document.createElement("div");
                        div2.className = "solutionImage";
                        const img = document.createElement("img");
                        img.src = item.media?item.media:"";
                        img.height = 200;
                        img.width = 200;
                        div2.appendChild(img);
                        div.appendChild(div2);
                        const div3 = document.createElement("div");
                        div3.className = "solutionDetails";
                        const h3 = document.createElement("h3");
                        const xhttp1 = new XMLHttpRequest();
                        xhttp1.onload = function(){
                            if(this.status == 200){
                                //console.log(this.responseText);
                                const jsonData1 = JSON.parse(this.responseText);
                                //console.log(jsonData1);
                                h3.innerHTML = jsonData1.organizationName;
                            }
                        }
                        xhttp1.open("POST", "../controllers/ajax_publicSolutionView.php", true);
                        xhttp1.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                        xhttp1.send("username="+item.username); 
                        div3.appendChild(h3);
                        //div3.appendChild(document.createElement("br"));
                        const h33 = document.createElement("h3");
                        h33.innerHTML = item.solutionType;
                        div3.appendChild(h33);
                        const h31 = document.createElement("h3");
                        const xhttp2 = new XMLHttpRequest();
                        xhttp2.onload = function(){
                            if(this.status == 200){
                                //console.log(this.responseText);
                                const jsonData2 = JSON.parse(this.responseText);
                                //console.log(jsonData2);
                                for(const itemi of jsonData2){
                                    h31.innerHTML += "|"+itemi.sector+"|";
                                }
                            }
                        }
                        xhttp2.open("POST", "../controllers/ajax_publicSolutionView.php", true);
                        xhttp2.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                        xhttp2.send("solutionId="+item.solutionID);
                        div3.appendChild(h31);
                        //div3.appendChild(document.createElement("br"));
                        const h32 = document.createElement("h3");
                        h32.innerHTML = item.title;
                        div3.appendChild(h32);
                        //div3.appendChild(document.createElement("br"));
                        const p = document.createElement("p");
                        //p.innerHTML = item.challenge;
                        div3.appendChild(p);
                        div.appendChild(div3);
                        div.addEventListener("click", function(){
                            window.location.href = "solutionDetails.php?solutionId="+item.solutionID;
                        });
                        solutions.appendChild(div);
                        //solutions.appendChild(document.createElement("hr"));
                    }
                
                }
            }
            xhttp.open("GET", "../controllers/ajax_publicSolutionView.php?req="+filters, true);
            xhttp.send();
        }

    </script>
</head>
<body onload="loadData()">
    <h1>Solutions</h1>
    <div>
        <h3>Filter</h3>
        <div>
            I am looking for <b><label id="allSolutionsLabel" onclick="allSolutionsFilter()" style="color:blue;">All Solutions</label></b>  <br>
            <div id="allSolutionsHidden" hidden>
                <input type="text" name="allSolutions" id="allSolutions" placeholder="search" onkeyup="searchSolutionTypes()"><br>
                <div id="allSolutionsCheckBox"></div>
            </div>
            within <b><label id="allFocusAreasLabel" for="allFocusAreas" onclick="allFocusAreasFilter()" style="color:blue;">All Focus Areas</label></b>  <br>
            <div id="allFocusAreasHidden" hidden>
                <input type="text" name="allFocusAreas" id="allFocusAreas" placeholder="search" onkeyup="searchSectors()"><br>
                <div id="allFocusAreasCheckBox"></div>
            </div>
            operating in <b><label id="allRegionsLabel" for="allRegions" onclick="allRegionsFilter()" style="color:blue;">All Regions</label></b>  <br>
            <div id="allRegionsHidden" hidden>
                <input type="text" name="allRegions" id="allRegions" placeholder="search" onkeyup="searchRegions()"><br>
                <div id="allRegionsCheckBox"></div>
            </div>
            <div>
                sort: 
                <select name="sort" id="sortA" onchange="doSort()" >
                    <option value="newest">Newest</option>
                    <option value="oldest">Oldest</option>
                </select>
            </div>
        </div>
        <hr>
        <div>
            <div id="solutions"></div>
        </div>
        <div>
            <div class="pagination" id="pagination"></div>
        </div>
    </div>
</body>
</html>