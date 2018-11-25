using System.Collections;
using System.Collections.Generic;
using UnityEngine;
using UnityEngine.Networking;

public class BuildingWWWRequest : MonoBehaviour {

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

    public void UploadBuilding()
    {
        //StartCoroutine(UploadBuildingEnum());
    }

    IEnumerator UploadBuildingEnum(string buildData, string userName, string location ,string privicy)
    {
        string msg = "upload" + buildData + "-" + userName + "-" + location + "-" + privicy;

        using (UnityWebRequest www = UnityWebRequest.Get(url + "addChatMessage.php?message=\n" + msg))
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
        string msg = "download";

        using (UnityWebRequest www = UnityWebRequest.Get(url + "addChatMessage.php?message=\n" + msg))
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

                //load the build on the gaven transform
                HelperFuns.LoadShipFromJson(buildPos, respData[BUILDDATA]);

                //write code to show author name here, the author name is respData[USERNAME]
            }
        }
    }


}
