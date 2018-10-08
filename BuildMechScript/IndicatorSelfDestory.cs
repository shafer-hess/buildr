using System.Collections;
using System.Collections.Generic;
using UnityEngine;

public class IndicatorSelfDestory : MonoBehaviour {
    CheckOverlapping check;
	// Use this for initialization
	void Start () {
        check = transform.parent.GetComponent<CheckOverlapping>();
	}
	
	// Update is called once per frame
	void Update () {
		if(check.enabled == false)
        {
            Destroy(gameObject);
        }
	}
}
