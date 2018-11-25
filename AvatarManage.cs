using System.Collections;
using System.Collections.Generic;
using UnityEngine;
using UnityEngine.UI;

public class AvatarManage : MonoBehaviour {
    public Button[] avatars;
    public Button currAvatar;
    public GameObject ImageSelectPanel;
    // Use this for initialization
    void Start () {
        int i = PlayerPrefs.GetInt("avatar", -1);
        if (i != -1)
        {
            changeAvatar(i);
        }
	}
	
	// Update is called once per frame
	void Update () {
		
	}

    public void changeAvatar(int i)
    {
        if (i > 6)
        {
            return;
        }
        currAvatar.GetComponent<Image>().sprite = avatars[i].GetComponent<Image>().sprite;
        PlayerPrefs.SetInt("avatar", i);
        PlayerPrefs.Save();
    }

    public void ShowImageSelectPanel(bool b)
    {
        ImageSelectPanel.SetActive(b);
    }

    public void TriggerImageSelectPanel()
    {
        if (ImageSelectPanel.activeInHierarchy)
        {
            ShowImageSelectPanel(false);
        }
        else
        {
            ShowImageSelectPanel(true);
        }
    }
}
