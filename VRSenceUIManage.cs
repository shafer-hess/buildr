using System.Collections;
using System.Collections.Generic;
using UnityEngine;
using UnityEngine.UI;

public class VRSenceUIManage : MonoBehaviour {

    public GameObject chartPanel;
	// Use this for initialization
	void Start () {
		
	}
	
	// Update is called once per frame
	void Update () {
		
	}

    public void OpenChart(bool b)
    {
        if (b)
        {
            chartPanel.SetActive(true);
        }
        else
        {
            chartPanel.SetActive(false);
        }
    }
    
    public void ChartTrigger()
    {
        if (chartPanel.activeInHierarchy)
        {
            OpenChart(false);
        }
        else
        {
            OpenChart(true);
        }
    }
}
