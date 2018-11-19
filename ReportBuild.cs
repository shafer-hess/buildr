using System.Collections;
using System.Collections.Generic;
using UnityEngine;
using UnityEngine.Networking;

public class ReportBuild : MonoBehaviour {

    string url = "http://ec2-18-217-185-132.us-east-2.compute.amazonaws.com/";

    IEnumerator ReportBuildingEnum()
    {
        using (UnityWebRequest www = UnityWebRequest.Get(url + "reportBuild.php?message=" + "dummyBuildName"))
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
