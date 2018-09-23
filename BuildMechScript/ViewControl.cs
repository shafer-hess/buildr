using System.Collections;
using System.Collections.Generic;
using UnityEngine;

public class ViewControl : MonoBehaviour {

    public float speed = 6f;

    Vector3 movement;

    public enum RotationAxes { MouseXAndY = 0, MouseX = 1, MouseY = 2, locked = 3 }
    public RotationAxes axes = RotationAxes.MouseXAndY;
    public float sensitivityX = 15F;
    public float sensitivityY = 15F;

    public float minimumX = -360F;
    public float maximumX = 360F;

    public float minimumY = -90F;
    public float maximumY = 90F;

    public Transform target;

    float rotationY = 0F;

    // Use this for initialization
    void Start () {
        target = null;
    }
	
	// Update is called once per frame
	void LateUpdate () {

        float z = Input.GetAxisRaw("updown");
        float h = Input.GetAxisRaw("Horizontal");
        float v = Input.GetAxisRaw("Vertical");
        

        if (axes == RotationAxes.MouseXAndY)
        {
            movement = v * speed * Camera.main.transform.forward + h * speed * Camera.main.transform.right + z * speed * Vector3.up;
            Camera.main.transform.position += movement;
            float rotationX = transform.localEulerAngles.y + Input.GetAxis("Mouse X") * sensitivityX;

            rotationY += Input.GetAxis("Mouse Y") * sensitivityY;
            rotationY = Mathf.Clamp(rotationY, minimumY, maximumY);

            transform.localEulerAngles = new Vector3(-rotationY, rotationX, 0);
        }
        else if (axes == RotationAxes.MouseX)
        {
            transform.Rotate(0, Input.GetAxis("Mouse X") * sensitivityX, 0);
        }
        else if (axes == RotationAxes.MouseY)
        {
            rotationY += Input.GetAxis("Mouse Y") * sensitivityY;
            rotationY = Mathf.Clamp(rotationY, minimumY, maximumY);

            transform.localEulerAngles = new Vector3(-rotationY, transform.localEulerAngles.y, 0);
        }
        else
        {
            movement = v * speed * Vector3.forward + h * speed * Vector3.right + z * speed * Vector3.up;
            Camera.main.transform.position += movement;
        }
    }

    public void lockRota()
    {
        if (axes == RotationAxes.locked)
        {
            axes = RotationAxes.MouseXAndY;
        }
        else
        {
            axes = RotationAxes.locked;
        }
    }
}
