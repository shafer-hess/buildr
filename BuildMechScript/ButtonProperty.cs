using System.Collections;
using System.Collections.Generic;
using UnityEngine;
using UnityEngine.UI;
using UnityEngine.EventSystems;

public class ButtonProperty : MonoBehaviour, IPointerEnterHandler
{
    GameObject description;
    [TextArea]
    public string descriptionStr;
	// Use this for initialization
	void Start () {
        description = GameObject.Find("TextDescription");
        //Debug.Log("<<<<<<<<" + description);
        
	}

    public void OnPointerEnter(PointerEventData eventData)
    {
        //Debug.Log("<<<<<<<<" + descriptionStr);
        description.GetComponent<Text>().text = descriptionStr;
    }
}
