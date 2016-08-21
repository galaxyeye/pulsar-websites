/**
 * Created by vincent on 16-8-20.
 */

var metadata = {
    "fields": [{
        "label": "Name",
        "value": "Name",
        "type": "string"
    }, {
        "label": "Age",
        "value": "Age",
        "type": "numerical"
    }, {
        "label": "SSN",
        "value": "SSN",
        "type": "string"
    }, {
        "label": "sourceIp",
        "value": "sourceIp",
        "type": "string"
    }, {
        "label": "targetIp",
        "value": "targetIp",
        "type": "string"
    }, {
        "label": "amount",
        "value": "amount",
        "type": "numerical"
    }, {
        "label": "bonus",
        "value": "bonus",
        "type": "numerical"
    }, {
        "label": "registered",
        "value": "registered",
        "type": "boolean"
    }, {
        "label": "priority",
        "value": "priority",
        "type": "numerical"
    }, {
        "label": "device",
        "value": "device",
        "type": "string"
    }],
    "operators": [{
        "label": "=",
        "value": "=",
        "type": "numerical"
    }, {
        "label": "==",
        "value": "==",
        "type": "numerical"
    }, {
        "label": "!=",
        "value": "!=",
        "type": "numerical"
    }, {
        "label": ">=",
        "value": ">=",
        "type": "numerical"
    }, {
        "label": "<=",
        "value": "<=",
        "type": "numerical"
    }, {
        "label": "<",
        "value": "<",
        "type": "numerical"
    }, {
        "label": ">",
        "value": ">",
        "type": "numerical"
    }, {
        "label": "is",
        "value": "is",
        "type": "boolean"
    }, {
        "label": "isNot",
        "value": "isNot",
        "type": "boolean"
    }, {
        "label": "matches",
        "value": "matches",
        "type": "string"

    }, {
        "label": "startsWith",
        "value": "startsWith",
        "type": "string"

    }, {
        "label": "endsWith",
        "value": "endsWith",
        "type": "string"
    }, {
        "label": "like",
        "value": "like",
        "type": "string"
    }, {
        "label": "contains",
        "value": "contains",
        "type": "string"
    }, {
        "label": "range",
        "value": "range",
        "type": "string"
    }]
};

var treeintableWidget3 = null;
var storeWidget3 = null;

$(document).ready(function () {
    $("#load").click(function () {
        //alert("Value: " + $("#textarea").val());
        var mathString = $("#textarea").val();
        if (mathString.trim().length == 0) return;
        try {
            var mathJson = esprima.parse(mathString);

            //treeintableWidget3.element.children()[0].remove();  //failed in IE and Safari
            $(treeintableWidget3.element).empty();

            var store3 = $("<div></div>")
                .appendTo("body")
                .datastore({
                    data: mathJson,
                    // once receives "complete" event from "datastore" object. carry on this function
                    complete: function (event, data) {
                        loadConditionEditor(event, data);
                    }
                });
        } catch (e) {
            alert("Failed to parse " + mathString + "\n" + e);
        }
    });

    $("#math").click(function () {
        var mathString = treeintableWidget3.getMathExpression();
        alert("Boolean Expresson:\n" + mathString);
    });

    $("#json").click(function () {
        var mathString = treeintableWidget3.getMathExpression();
        var mathJson = esprima.parse(mathString);
        alert("JSON (you can submit to sever to validate and  search data) \n" + JSON.stringify(mathJson, null, " "));
    });
});

var loadConditionEditor = function (event, data) {
    console.log("datastore build complete");
    //instantiate "treeintable" object.
    var treeinTableNode = $("#treeintable3").conditioneditor({
        store: store3,
        metadata: metadata,
        checkEquationeditorValidity: function (equationobject) {
            // override checkConditionValidity(). developer can customize data validation logic
            // For example, (sourceIp1=="10.1.2.t")||matches(Name, ok) --> sourceIp1 is not in medatdata, 10.1.2.t is not a valid IP address

            var obj = {};

            //check if FIELD input is in meta-data
            var isFieldInMetaData = this.metadataUtil.isItemInMetaData("fields", "value", equationobject.left);


            if (!isFieldInMetaData) {
                var msg = "[" + equationobject.left + "] is not known.  It is not in the metadata list";
                obj.message = (obj.message) ? obj.message + " " + msg : msg;
            }

            // validate if the operator is valid
            // For example: matchesXXX(Name, ok)  --> "matchesXXX" is not a supported function
            var isOperatorValid = this.metadataUtil.isItemInMetaData("operators", "value", equationobject.operator);
            var ops = metadata.operators;

            if (!isOperatorValid) {
                var msg = "[" + equationobject.operator + "] is not a supported function.  It is not in the metadata list";
                obj.message = (obj.message) ? obj.message + " " + msg : msg;

            }


            var isValueVadid = true;
            // you can right code to check equationobject.right is correct
            //For example (sourceIp1=="10.1.2.t") 10.1.2.t is not a valid IP address
            if (equationobject.left == "sourceIp" || equationobject.left == "targetIp") {

                if (this.metadataUtil.isItemInMetaData("fields", "value", equationobject.right)) {
                    // if user pick "targetIp" in the value combobox. It means [sourceIp] matches [targetIp].  This is a valid case
                    return null;
                }

                var ipformat = /^(?=\d+\.\d+\.\d+\.\d+$)(?:(?:25[0-5]|2[0-4][0-9]|1[0-9]{2}|[1-9][0-9]|[0-9])\.?){4}$/;
                var ipformat2 = /^(25[0-4]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)$/;
                var ipformat3 = /^(([1-9]|[1-9][0-9]|1[0-9]{2}|2[0-4][0-9]|25[0-5])\.){3}([0-9]|[1-9][0-9]|1[0-9]{2}|2[0-4][0-9]|25[0-5])$/;
                isValueVadid = ipformat.test(equationobject.right) && ipformat2.test(equationobject.right) && ipformat3.test(equationobject.right);
                if (!isValueVadid) {
                    var msg = "[" + equationobject.right + "] is not a valid IP address";
                    obj.message = (obj.message) ? obj.message + " " + msg : msg;
                }
            }
            if (isValueVadid && isFieldInMetaData && isOperatorValid) {
                return null;
            } else {
                //obj.row = trNode;
                return obj;
            }
        },
        getValueFromEquationEditor: function (type) {
            // override getValueFromEquationEditor(), this api controls what value to populate to equation-editor (where user configurs something like "a>b")
            var equationeditorWidget = this.equationeditor.data("iseEquationeditor");
            if (type == "field") {
                return equationeditorWidget.getFieldWidget().selectedValue.value;
            } else if (type == "operator") {
                return equationeditorWidget.getOperatorWidget().selectedValue.value;
            } else if (type == "value") {
                return equationeditorWidget.getValueWidget().selectedValue.value;
            }
            return null;
        },
        getMathExpressFromEquationDataItem: function (dataItem) {
            // override getMathExpressFromEquationDataItem().  Develper can control how to generate math-expression
            var opLeft = dataItem.left
            var opRight = dataItem.right;
            var operator = dataItem.operator;
            var conditioneditor = this;
            var opType = null;
            var ops = metadata.operators;
            for (var i = 0; i < ops.length; i++) {
                if (operator == ops[i].value) {
                    opType = ops[i].type;
                    break;
                }
            }
            if (opType && opType != "numerical") {
                return operator + "( " + opLeft.name + " ," + opRight.value + ")";
            }
            return dataItem.expression;
        },
        onEquationEditoronFormCreateComplete: function (conditioneditor, equationeditor, fieldwidget, operatorwidget, valuewidget) {
            if (this.debug) console.log(" test file conditionEditor -> onEquationEditoronFormCreateComplete()");

            //operatorwidget.enable();
            //valuewidget.enable();

            //I am overriding onFieldInputChange() API.
            //When user changes "field" value, we can update "operator" and "value" widget according to specific business logic.
            equationeditor.onFieldInputChange = function (widget) {
                var fieldwidget = equationeditor.getFieldWidget();
                var operatorwidget = equationeditor.getOperatorWidget();
                var valuewidget = equationeditor.getValueWidget();
                if (this.debug) console.log("customized onFieldInputChange() " + JSON.stringify(widget.selectedValue));

                var fieldValue = fieldwidget.selectedValue;
                if (!fieldValue) return;

                // enable operator-combo and valuewidget-combo


                var fieldObj = conditioneditor.metadataUtil.getFieldObject(fieldValue, "value");
                if (fieldObj) {
                    operatorwidget.reset();
                    // if (fieldObj.type == "string") --> fill operatorwidget.selectOptions with "startsWith, endsWith..., etc"
                    operatorwidget.selectOptions = conditioneditor.metadataUtil.getOperatorsByType(fieldObj.type);
                    operatorwidget.selectOptions = operatorwidget.selectOptions.concat(conditioneditor.metadataUtil.getOperatorsByType("boolean"));
                }

                if (fieldObj.type != "boolean") {
                    // say user picks "name" field (a string type field),  we want to populate value-combo with all string type fields except "name"
                    var typeFields = conditioneditor.metadataUtil.getFieldsByType(fieldObj.type);
                    var idx = typeFields.indexOf(fieldObj);
                    typeFields.splice(idx, 1);
                    valuewidget.selectOptions = typeFields;
                }

                ///*  We can examine every select field's value and update operator-combo and value-combo accordingly.
                if (fieldValue.value == "name") {
                    // write you business logic
                    //operatorwidget.selectOptions = ...
                    //valuewidget.selectOptions  = ..
                } else {
                    // write you businese logic ...
                }

                //*/
                operatorwidget.reset();
                valuewidget.reset();
            };

            /*
             * Override the API onOperatorInputChange()
             * When ever user picks operator value, we can update the value-combo accordingly.
             */
            equationeditor.onOperatorInputChange = function (widget) {
                var fieldwidget = equationeditor.getFieldWidget();
                var operatorwidget = equationeditor.getOperatorWidget();
                var valuewidget = equationeditor.getValueWidget();
                if (conditioneditor.debug) console.log("customized onOperatorInputChange() " + JSON.stringify(widget.selectedValue));

                var fieldValue = fieldwidget.selectedValue;
                var operatorValue = operatorwidget.selectedValue;
                var operatorObj = conditioneditor.metadataUtil.getOperatorObject(operatorValue, "value");
                if (operatorObj.type == "boolean") {
                    var nullFields = [{
                        "label": "null",
                        "value": "null"
                    },
                        {
                            "label": "non null",
                            "value": "non null"
                        }];
                    valuewidget.selectOptions = nullFields;
                }

                valuewidget.reset();
            };

            /*
             * Override the API onValueInputChange()
             * When ever user picks operator value, we can update the value-combo accordingly.
             */
            equationeditor.onValueInputChange = function (widget) {
                if (equationeditor.debug) console.log("customized onValueInputChange() " + JSON.stringify(widget.selectedValue));
            };
        },
        debug: true
    });
    storeWidget3 = treeinTableNode.data("iseConditioneditor").store;  //"treeintable" old code
    treeintableWidget3 = treeinTableNode.data("iseConditioneditor");
    treeintableWidget3.decorateTablerow = function (cpmTableRow) {
        //instance level override the class api
        //console.log("instance override decorateTablerow()");
    };
    treeintableWidget3.onRowSelect = function (trNode) {
        console.log("TreeInColumnable-items onRowSelect()" + trNode.treetableArrayItem);
        // for debugging. Test various api
        //console.log("Validation Error List\n" + treeintableWidget3.validate());
        // console.log("getChildItemIndex(): " + treeintableWidget3.getChildItemIndex(trNode));
        // console.log(treeintableWidget3.getParentRowItem(trNode));
        // console.log(treeintableWidget3.getSubTree(trNode));
        // console.log(treeintableWidget3.getDirectChildren(trNode));
        // console.log(treeintableWidget3.getParentRowItemsList(trNode));
        // console.log(treeintableWidget3.getChildIndexOfParent(trNode));
        // console.log(treeintableWidget3.getPreviousSiblingRowItem(trNode));
        // console.log(treeintableWidget3.getNexeSiblingRowItem(trNode));
        //console.log("getRootLevelRowItems() " + treeintableWidget3.getRootLevelRowItems());
    };
    ///* You can override conditioneditor widget API like below
    treeintableWidget3.getEquationEditorValidationErrorTitle = function () {
        return 'Invadid Input';
    };
    //*/
    treeintableWidget3.buildTreeTable();
    treeintableWidget3.setTreetableDragAndDrop(); ////<------ enable Drag-and-Drop
};

var store3 =$( "<div></div>" )
//.appendTo( "body" )
    .datastore({
        url: "/data/test_ce.json",  // it is /* (priority==5) || (souceIp=="1.2.2.3") && ( device=="router") */
        // once receives "complete" event from "datastore" object. carry on this function
        complete: function( event, data ) {
            loadConditionEditor(event, data);
        }
    });
