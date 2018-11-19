using System.Collections;
using System.Collections.Generic;
using System.IO;
using UnityEngine;
using UnityEngine.UI;
using UnityEngine.Networking;

public class Uploading : MonoBehaviour {

    public GameObject shipScroll;
    public InputField shipNameInput;
    public Transform buildPos;

    string url = "http://ec2-18-217-185-132.us-east-2.compute.amazonaws.com/";

    const int BUILDDATA = 0;
    const int USERNAME = 1;

    // Use this for initialization
    void Start () {
		
	}
	
	// Update is called once per frame
	void Update () {
		
	}

    public void LoadAndSaveShip()
    {
        foreach (Transform t in shipScroll.transform)
        {
            Destroy(t.gameObject);
            Debug.Log(">>>>>>>>>>>>>>>Destoryed<<<<<<<<<<<<<<<<<");
        }

        string path = Application.persistentDataPath;
        Debug.Log(Application.persistentDataPath);
        string[] fileArray = Directory.GetFiles(path, "*.json");
        foreach (string fileName in fileArray)
        {

            GameObject b = (GameObject)Instantiate(Resources.Load("LoadButton"));
            b.transform.SetParent(shipScroll.GetComponent<VerticalLayoutGroup>().transform);
            Debug.Log(b);
            string shipName = fileName.Substring(fileName.LastIndexOf('/') + 1, fileName.Length - 6 - fileName.LastIndexOf('/'));
            b.GetComponent<Button>().onClick.AddListener(delegate { PutNameInInPutField(shipName); });
            b.GetComponentInChildren<Text>().text = shipName;
        }
    }

    private void PutNameInInPutField(string name)
    {
        shipNameInput.text = name;
    }

    public void UploadBuilding(string userName, string location, string privicy, string avatar)
    {
        string buildData = HelperFuns.LoadJsonFromName(shipNameInput.text);
        int i = PlayerPrefs.GetInt("avatar", -1);
        if (i == -1)
        {
            i = 0;
        }
        if (buildData.Length != 0)
        {
            StartCoroutine(UploadBuildingEnum(buildData, userName, location, privicy, i.ToString()));
        }
    }

    IEnumerator UploadBuildingEnum(string buildData, string userName, string location, string privicy, string avatar)
    {
        string msg = "upload" + buildData + "-" + userName + "-" + location + "-" + privicy + "-" + avatar;

        using (UnityWebRequest www = UnityWebRequest.Get(url + "uploadBuild.php?message=\n" + msg))
        {
            //www.chunkedTransfer = false;
            yield return www.SendWebRequest();

            if (www.isNetworkError || www.isHttpError)
            {
                Debug.Log(www.error);
            }
            else
            {
                // Show results as text
                Debug.Log(www.downloadHandler.text);
                //chartText.text = www.downloadHandler.text;
                //text.GetComponent<Text>().text = www.downloadHandler.text;

            }
        }
    }

    IEnumerator DownLoadBuildingEnum()
    {
        using (UnityWebRequest www = UnityWebRequest.Get(url + "downloadBuild.php"))
        {
            //www.chunkedTransfer = false;
            yield return www.SendWebRequest();

            if (www.isNetworkError || www.isHttpError)
            {
                Debug.Log(www.error);
            }
            else
            {
                string response = www.downloadHandler.text;
                Debug.Log(response);
                string[] respData = response.Split('-');

                /*load the build on the gaven transform, the third arguement is the scale of
                 * the build, initial block demision is 5m*5m*5m
                */

                HelperFuns.LoadShipFromJson(buildPos, respData[BUILDDATA], 0.01f);

                //write code to show author name here, the author name is respData[USERNAME]
            }
        }
    }

    IEnumerator UpvoteBuildingEnum()
    {
        using (UnityWebRequest www = UnityWebRequest.Get(url + "upvoteBuild.php?message=" + "dummyBuildName"))
        {
            //www.chunkedTransfer = false;
            yield return www.SendWebRequest();

            if (www.isNetworkError || www.isHttpError)
            {
                Debug.Log(www.error);
            }
            else
            {
                string response = www.downloadHandler.text;
                Debug.Log(response);
            }
        }
    }
}
