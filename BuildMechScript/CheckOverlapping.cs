using System.Collections;
using System.Collections.Generic;
using UnityEngine;

public class CheckOverlapping : MonoBehaviour {

    public bool overlapped = false;
    public int maxScale;
    public bool fixUp=false;
    public bool canBeHit = true;

    void Start()
    {

    }

    void OnTriggerStay(Collider col)
    {
        overlapped = true;
        //Debug.Log("overlapped");
    }
    void OnTriggerExit(Collider col)
    {
        overlapped = false;
    }
}
